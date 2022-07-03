<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailMailable;

class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SENDS AN EMAIL TO THE ADMINISTRATOR AND TO THE SELLER IF THE STOCK IS LESS THAN OR EQUAL TO 10';

    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $correo = new EmailMailable;
        Mail::to('dsada@gmail.com')->send($correo);

        Log::info("cron ejecutandose");
       // return 0;
    }
}
