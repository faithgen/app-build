<?php

namespace Faithgen\AppBuild\Traits;

use Faithgen\AppBuild\Models\BuildRequest;

trait HasManyBuildRequests
{
    public function buildRequests()
    {
        return $this->hasMany(BuildRequest::class);
    }
}
