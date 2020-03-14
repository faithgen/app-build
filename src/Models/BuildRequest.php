<?php

namespace Faithgen\AppBuild\Models;

use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\Relationships\Belongs\BelongsToMinistryTrait;

class BuildRequest extends UuidModel
{
    use BelongsToMinistryTrait;

    protected $guarded = ['id'];
}
