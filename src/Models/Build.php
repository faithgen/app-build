<?php

namespace App;

use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\Relationships\Belongs\BelongsToMinistryTrait;

class Build extends UuidModel
{
    use BelongsToMinistryTrait;

    protected $guarded = ['id'];
    protected $table = 'app_builds';
}
