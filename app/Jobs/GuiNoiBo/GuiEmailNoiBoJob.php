<?php

namespace App\Jobs\GuiNoiBo;

use App\Mail\GuiEmailPRBoPhanKinhDoanhMail;
use App\Mail\GuiEmailPRChoToanNhanVienMail;
use App\Mail\GuiEmailTongHopAnPhamMKTNoiBoMail;
use App\Mail\GuiTongHopTemplateEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GuiEmailNoiBoJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $name;
    public $email;
    public $loaiEmail;

    public function __construct($name, $email, $loaiEmail)
    {
        $this->name = $name;
        $this->email = $email;
        $this->loaiEmail = $loaiEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $name = $this->name;
        $loaiEmail = $this->loaiEmail;
        // $bccEmail = 'han.le@3ds.vn';

        $emailsToExclude = [
        'Thonguoi01@3ds.vn',
        'Thonguoi-02@3ds.vn',
        'Taixe-01@3ds.vn',
        'Taixe-02@3ds.vn',
        'quochung.nguyen@3ds.vn',
        'sales-02@3ds.vn',
    ];

        if (in_array($email, $emailsToExclude)) {
            Log::warning("Đã bỏ qua (exclude) gửi email '$loaiEmail' tới '$email'");

            return;
        }

        // Khởi tạo một biến để chứa Mailable
        $mailable = null;

        // Gán đúng Mailable dựa trên $loaiEmail
        switch ($loaiEmail) {
        case 'PR-toan-nhan-vien':
            $mailable = new GuiEmailPRChoToanNhanVienMail($name);
            break;
        case 'tong-hop-template-email':
            $mailable = new GuiTongHopTemplateEmail($name);
            break;
        case 'an-pham-mkt-noi-bo':
            $mailable = new GuiEmailTongHopAnPhamMKTNoiBoMail($name);
            break;
        case 'PR-bo-phan-kinh-doanh':
            $mailable = new GuiEmailPRBoPhanKinhDoanhMail($name);
            break;
        default:
            Log::warning("Loại email không xác định: '$loaiEmail'");
            break;
    }

        // Nếu $mailable đã được tạo, tiến hành gửi email
        if ($mailable) {
            Mail::to($email)
            // ->bcc($bccEmail)
            ->send($mailable);
        }
    }
}
