<?php

namespace Faithgen\AppBuild\Traits;

use Faithgen\AppBuild\Models\BuildRequest;

trait HasManyBuildRequests
{
    function buildRequests()
    {
        return $this->hasMany(BuildRequest::class);
    }
}
