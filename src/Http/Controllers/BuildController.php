<?php

namespace Faithgen\AppBuild\Http\Controllers;

use Faithgen\AppBuild\Http\Requests\BuildAppRequest;
use Faithgen\AppBuild\Http\Resources\Build as BuildResource;
use Faithgen\AppBuild\Http\Resources\BuildLog as LogResource;
use Faithgen\AppBuild\Jobs\BuildApp;
use Faithgen\AppBuild\Jobs\FinishBuilds;
use Faithgen\AppBuild\Models\Build;
use Faithgen\AppBuild\Services\BuildService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use InnoFlash\LaraStart\Http\Helper;
use InnoFlash\LaraStart\Traits\APIResponses;

class BuildController extends Controller
{
    use APIResponses;
    use AuthorizesRequests;

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

    /**
     * Sends a build request to the terminal.
     *
     * @param BuildAppRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function buildApp(BuildAppRequest $request)
    {
        $profileUpdated = auth()->user()->profile()->update([
            'app_name' => $request->app_name
        ]);

        if ($profileUpdated) {
            if ($request->release) {
                $lastBuild = auth()->user()->builds()->latest()->first();
                if (!$lastBuild) $version = '1.0.0';
                else {
                    $version = (int)((string)Str::of($lastBuild->version)
                        ->replace('.', ''));
                    $version++;
                    $version = str_split($version);
                    $version = implode('.', $version);
                }
                $this->buildService->createFromParent(['version' => $version]);
            }
            BuildApp::dispatch($request->release);
            return $this->successResponse('Building app now, you will be notified via email when its done');
        } else abort(500, 'Failed to update app name');
    }

    /**
     * Gets the builds of the app paginated.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $builds = auth()->user()->builds()
            ->with('buildLogs')
            ->latest()
            ->paginate(Helper::getLimit($request));

        FinishBuilds::dispatch(auth()->user()->id);

        BuildResource::wrap('builds');

        return BuildResource::collection($builds);
    }

    public function buildLogs(Build $build)
    {
        $this->authorize('view', $build);
        $build->load('buildLogs');
        LogResource::wrap('logs');

        return LogResource::collection($build->buildLogs);
    }
}
