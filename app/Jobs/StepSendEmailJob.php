<?php

namespace App\Jobs;

use App\Models\Leads\Lead;
use App\Models\Machines\Step;
use App\Notifications\MachineStep;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StepSendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Lead $lead)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->lead->notify(new MachineStep);
    }
}
