<?php

namespace Faithgen\AppBuild\Jobs;

use Faithgen\AppBuild\Models\BuildRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BuildApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var bool
     */
    private bool $release;

    /**
     * @var string
     */
    private string $ministryId;

    /**
     * Create a new job instance.
     *
     * @param bool $release
     * @param string $ministryId
     */
    public function __construct(bool $release, string $ministryId)
    {
        $this->release = $release;
        $this->ministryId = $ministryId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        BuildRequest::create([
            'ministry_id' => $this->ministryId,
            'release' => $this->release
        ]);
    }
}
