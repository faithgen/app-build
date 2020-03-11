<?php

namespace Faithgen\AppBuild\Http\Controllers;

use Faithgen\AppBuild\Services\BuildService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BuildController extends Controller
{
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
}
