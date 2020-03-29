<?php

namespace Faithgen\AppBuild\Http\Controllers;

use Faithgen\AppBuild\Http\Requests\AddModulesRequest;
use Faithgen\AppBuild\Http\Requests\Modules\CommentRequest;
use Faithgen\AppBuild\Http\Resources\Module as ModuleResource;
use Faithgen\AppBuild\Http\Resources\ModuleDetails;
use Faithgen\AppBuild\Http\Resources\Template as TemplateResource;
use Faithgen\AppBuild\Models\Module;
use Faithgen\AppBuild\Models\Template;
use Faithgen\AppBuild\Services\ModuleService;
use FaithGen\SDK\Helpers\CommentHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use InnoFlash\LaraStart\Traits\APIResponses;

class ModuleController extends Controller
{
    use APIResponses;
    /**
     * @var ModuleService
     */
    private ModuleService $moduleService;

    /**
     * ModuleController constructor.
     *
     * Injects the module service into the controller.
     *
     * @param ModuleService $moduleService
     */
    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Fetches the modules this ministry is subscribed to
     *
     */
    public function index()
    {
        $modules = $this->moduleService->getModel()
            ->active()
            ->exclude(['description'])
            ->withCount('comments')
            ->get();

        return response()->json([
            'modules' => ModuleResource::collection($modules),
            'data' => [
                'app_name' => auth()->user()->profile->app_name,
                'templates' => TemplateResource::collection(Template::latest()
                    ->exclude(['description'])
                    ->get())
            ]
        ], 200);
    }

    public function addModules(AddModulesRequest $request)
    {
        $this->moduleService->invalidateModules();

        if ($this->moduleService->addModules($request->modules))
            return $this->successResponse('Modules updated successfully');
    }

    /**
     * Gets the module with its images.
     *
     * @param Module $module
     * @return ModuleDetails
     */
    public function show(Module $module)
    {
        $module->load(['images']);

        ModuleDetails::withoutWrapping();

        return new ModuleDetails($module);
    }

    /**
     * Fetches the comments of a module.
     *
     * @param Request $request
     * @param Module $module
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function comments(Request $request, Module $module)
    {
        return CommentHelper::getComments($module, $request);
    }

    /**
     * Sends a comment for the given module.
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(CommentRequest $request)
    {
        return CommentHelper::createComment($this->moduleService->getModule(), $request);
    }

}
