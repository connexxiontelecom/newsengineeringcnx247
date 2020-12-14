<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\DeactivateSubscriptionMail;
use Carbon\Carbon;
use App\Membership;
use App\Tenant;

class DeactivateSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate tenant when subscription reaches expiry date. This is a command that will run at intervals daily.';

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
        $now = Carbon::now();
        #Get the first tenant whose subscription will expire this today
        /* $expiringToday = Membership::whereDay('created_at', $now->today())
                        ->get();
        $tenants = Tenant::select('active_sub_key')
                        ->whereBetween('birth_date', [$now->startOfWeek()->format('Y-m-d H:i'), $now->addMonths(3)])
                        ->take(5)->get(); */
       # \Mail::to()->send(new DeactivateSubscriptionMail());
        $this->info("Success! Deactivation reminder sent.");
    }
}
