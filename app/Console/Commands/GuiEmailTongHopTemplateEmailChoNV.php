<?php

namespace App\Console\Commands;

use App\Jobs\GuiNoiBo\GuiEmailNoiBoJob;
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
        $loaiEmail = 'tong-hop-template-email';
        foreach ($users as $email => $name) {
            GuiEmailNoiBoJob::dispatch($name, $email,$loaiEmail)->delay(now()->addMinutes(1));
        }

        return 0;
    }
}
