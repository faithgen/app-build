<?php

namespace Faithgen\AppBuild\Http\Controllers;

use Faithgen\AppBuild\Http\Requests\BuildAppRequest;
use Faithgen\AppBuild\Jobs\BuildApp;
use Faithgen\AppBuild\Services\BuildService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use InnoFlash\LaraStart\Traits\APIResponses;

class BuildController extends Controller
{
    use APIResponses;

    /**
     * @var BuildService
     */
    private BuildService $buildService;

    /**
     * BuildController constructor.
     *
     * @param BuildService $buildService
     */
    public function __construct(BuildService $buildService)
    {
        $this->buildService = $buildService;
    }

    public function buildApp(BuildAppRequest $request)
    {
        $profileUpdated = auth()->user()->profile()->update([
            'app_name' => Str::title($request->app_name)
        ]);

        if ($profileUpdated) {
            if ($request->release) {
                $lastBuild = auth()->user()->builds()->latest()->first();
                if (!$lastBuild) $version = '1.0.0';
                else{
                    $version = (int) ((string) Str::of($lastBuild->version)
                            ->replace('.', ''));
                    $version++;
                    $version = str_split($version);
                    $version = implode('.', $version);
                }
                $this->buildService->createFromParent(['version' => $version]);
            }
            BuildApp::dispatch();
            return $this->successResponse('Building app now, you will be notified via email when its done');
        } else abort(500, 'Failed to update app name');
    }
}
