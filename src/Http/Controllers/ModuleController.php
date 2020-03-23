<?php

namespace Faithgen\AppBuild\Http\Controllers;

use Faithgen\AppBuild\Models\Template;
use Faithgen\AppBuild\Services\ModuleService;
use Faithgen\AppBuild\Http\Requests\AddModulesRequest;
use Faithgen\AppBuild\Http\Resources\Module as ModuleResource;
use Faithgen\AppBuild\Http\Resources\Template as TemplateResource;
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
            ->get();

        return response()->json([
            'modules' => ModuleResource::collection($modules),
            'data' => [
                'app_name' => auth()->user()->profile->app_name,
                'templates' => TemplateResource::collection(Template::latest()->get())
            ]
        ], 200);
    }

    public function addModules(AddModulesRequest $request)
    {
        $this->moduleService->invalidateModules();

        if ($this->moduleService->addModules($request->modules))
            return $this->successResponse('Modules updated successfully');
    }
}
