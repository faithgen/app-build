<?php

namespace Faithgen\AppBuild\Http\Controllers;

use Faithgen\AppBuild\Http\Requests\Templates\CommentRequest;
use Faithgen\AppBuild\Http\Resources\Template as TemplateResource;
use Faithgen\AppBuild\Models\Template;
use Faithgen\AppBuild\Services\TemplateService;
use FaithGen\SDK\Helpers\CommentHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use InnoFlash\LaraStart\Helper;
use InnoFlash\LaraStart\Http\Requests\IndexRequest;

class TemplateController extends Controller
{
    /**
     * @var TemplateService
     */
    private TemplateService $templateService;

    /**
     * TemplateController constructor.
     * @param TemplateService $templateService
     */
    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    /**
     * Fetches the templates.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $templates = Template::latest()
            ->withCount('comments')
            ->active()
            ->search(['name', 'branch', 'repository', 'description'], $request->filter_text)
            ->paginate(Helper::getLimit($request));

        TemplateResource::wrap('templates');

        return TemplateResource::collection($templates);
    }

    /**
     * Fetches the comments of a template.
     *
     * @param Request $request
     * @param Template $template
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function comments(Request $request, Template $template)
    {
        return CommentHelper::getComments($template, $request);
    }

    /**
     * Sends a comment for the given template.
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(CommentRequest $request)
    {
        return CommentHelper::createComment($this->templateService->getTemplate(), $request);
    }

    public function show(Template $template)
    {
        $template->load('images');

        TemplateResource::withoutWrapping();

        return new TemplateResource($template);
    }
}
