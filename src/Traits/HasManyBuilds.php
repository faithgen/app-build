<?php

namespace Faithgen\AppBuild\Traits;

use Faithgen\AppBuild\Models\Build;

trait HasManyBuilds
{
    /**
     * Gives the calling ministry many builds.
     *
     * @return mixed
     */
    function builds()
    {
        return $this->hasMany(Build::class);
    }
}
