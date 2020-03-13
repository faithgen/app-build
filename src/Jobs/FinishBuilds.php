<?php

namespace Faithgen\AppBuild\Jobs;

use Faithgen\AppBuild\Models\Build;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FinishBuilds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private string $ministryId;

    /**
     * Create a new job instance.
     *
     * @param string $ministryId
     */
    public function __construct(string $ministryId)
    {
        $this->ministryId = $ministryId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pendingBuilds = Build::where([
            'ministry_id' => $this->ministryId,
            'status' => 'building'
        ])->where(function ($build) {
            return $build->whereDate('created_at', '>=', now()->addHours(5));
        })->get();

        foreach ($pendingBuilds as $pendingBuild) {
            $failedLogsCount = $pendingBuild->buildLogs()
                ->where('success', false)
                ->where('task', '!=', 'copy:logo')
                ->count();

            if ($failedLogsCount) $status = 'failed';
            else $status = 'successful';

            $pendingBuild->update([
                'status' => $status
            ]);
        }
    }
}
