<?php

namespace App\Console\Commands;

use App\Mail\GuiEmailChucMungSinhNhatNhanVienMail;
use App\Models\User;
use App\Traits\GetflyApiV6;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GuiChucMungSinhNhatNhanVien extends Command
{
    use GetflyApiV6;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gui-chuc-mung-sinh-nhat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::ActiveEmployees()->get();
        $dem = 0;
        foreach($users as $user){
            if($user->profile && $user->profile->birthday == null){
                // dd($user);
                $reponse = $this->getToGetFlyV6([
                "fields" => "custom_fields,account_code,account_name,mgr_display_name,mgr_email,
                    birthday,description,relation_id,total_revenue,phone_office,email,billing_address_street,sic_code,
                    account_type,account_source,contacts",
                "filtering" => [
                    "id" => 2187
                ]
            ],"accounts");
            $reponseDecode = json_decode($reponse);
            $dataKhachHang = $reponseDecode->data[0];

            foreach($dataKhachHang->contacts as $contact){
                if($user->email == $contact->email){
                    $timestamp = $contact->birthdate;
                    $formattedDate = date("Y-m-d", $timestamp);
                    $user->profile->update(['birthday' => $formattedDate]);
                }
            }
            }

            $bccEmails = collect([
            'han.le@3ds.vn',
            config('services.email.nhan-su')
        ])->filter();

            // check nếu hôm này là sinh nhật thì gửi email chúc mừng
            if($user->profile && $user->profile->birthday != null){
                if(date('m-d') == date('m-d',strtotime($user->profile->birthday))){
                    Mail::to($user->email)
                    ->bcc($bccEmails)
                    ->send(new GuiEmailChucMungSinhNhatNhanVienMail($user));
                }

            }
        }

        return 0;
    }
}
