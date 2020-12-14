<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SevenDaysReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sevendays:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a 7 days reminder to tenant about his/her subscription - expiration.';

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
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
