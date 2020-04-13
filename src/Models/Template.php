<?php

namespace Faithgen\AppBuild\Models;

use Faithgen\AppBuild\Traits\HasManyBuildRequests;
use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\ActiveTrait;
use FaithGen\SDK\Traits\Relationships\Morphs\CommentableTrait;
use FaithGen\SDK\Traits\Relationships\Morphs\ImageableTrait;
use FaithGen\SDK\Traits\StorageTrait;
use Illuminate\Support\Str;

class Template extends UuidModel
{
    use HasManyBuildRequests;
    use ImageableTrait;
    use CommentableTrait;
    use StorageTrait;
    use ActiveTrait;

    protected $guarded = ['id'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getNameAttribute($val)
    {
        return Str::title($val);
    }

    /**
     * {@inheritdoc}
     */
    public function filesDir()
    {
        return 'templates';
    }

    /**
     * {@inheritdoc}
     */
    public function getFileName()
    {
        return $this->images()
            ->pluck('name')
            ->toArray();
    }

    public function getImageDimensions()
    {
        return [0];
    }
}
