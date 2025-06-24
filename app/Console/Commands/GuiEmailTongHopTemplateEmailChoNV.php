<?php

namespace App\Console\Commands;

use App\Mail\GuiTongHopTemplateEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GuiEmailTongHopTemplateEmailChoNV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gui-tong-hop-template-email-cho-nv';

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
        $users = User::ActiveEmployees()->pluck('name', 'email')->toArray();
        foreach ($users as $email => $name) {
            // Assuming you have a method to send the email
            // You can replace this with your actual email sending logic
            Mail::to($email)
                    ->send(new GuiTongHopTemplateEmail($name));
        }

        return 0;
    }
}
