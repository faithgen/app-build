<?php

namespace Faithgen\AppBuild\Models;

use Faithgen\AppBuild\Traits\HasManyBuildRequests;
use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\Relationships\Morphs\ImageableTrait;

class Template extends UuidModel
{
    use HasManyBuildRequests;
    use ImageableTrait;

    protected $guarded = ['id'];
}
