<?php

namespace Faithgen\AppBuild\Models;

use Faithgen\AppBuild\Traits\HasManyBuildRequests;
use FaithGen\SDK\Models\UuidModel;

class Template extends UuidModel
{
    use HasManyBuildRequests;

    protected $guarded = ['id'];
}
