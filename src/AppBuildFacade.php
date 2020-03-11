<?php

namespace Faithgen\AppBuild;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Faithgen\AppBuild\Skeleton\SkeletonClass
 */
class AppBuildFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'app-build';
    }
}
