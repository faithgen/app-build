<?php

namespace Faithgen\AppBuild\Http\Controllers;

use Faithgen\AppBuild\Services\TemplateService;
use Illuminate\Routing\Controller;

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
}
