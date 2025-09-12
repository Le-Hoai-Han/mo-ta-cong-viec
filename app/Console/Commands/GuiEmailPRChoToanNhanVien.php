<?php

namespace App\Console\Commands;

use App\Jobs\GuiNoiBo\GuiEmailNoiBoJob;
use App\Mail\GuiEmailPRChoToanNhanVienMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GuiEmailPRChoToanNhanVien extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gui-email-pr-cho-toan-nhan-vien';

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

        $loaiEmail = 'PR-toan-nhan-vien';
        $users = User::ActiveEmployees()
        // ->where('id', 103)
        ->pluck('name', 'email')
        ->toArray();
        foreach ($users as $email => $name) {
            GuiEmailNoiBoJob::dispatch($name, $email,$loaiEmail)->delay(now()->addMinutes(1));
        }

        return 0;
    }
}
