<?php

namespace Faithgen\AppBuild\Models;

use Faithgen\AppBuild\Traits\HasManyBuildRequests;
use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\Relationships\Morphs\CommentableTrait;
use FaithGen\SDK\Traits\Relationships\Morphs\ImageableTrait;
use Illuminate\Support\Str;

class Template extends UuidModel
{
    use HasManyBuildRequests;
    use ImageableTrait;
    use CommentableTrait;

    protected $guarded = ['id'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    function getNameAttribute($val)
    {
        return Str::title($val);
    }
}
