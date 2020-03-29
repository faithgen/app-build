<?php

namespace Faithgen\AppBuild\Models;

use Faithgen\AppBuild\Traits\ManyMinistryModules;
use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\ActiveTrait;
use FaithGen\SDK\Traits\Relationships\Morphs\CommentableTrait;
use FaithGen\SDK\Traits\Relationships\Morphs\ImageableTrait;
use FaithGen\SDK\Traits\StorageTrait;
use Illuminate\Support\Str;

final class Module extends UuidModel
{
    use ManyMinistryModules;
    use ActiveTrait;
    use ImageableTrait;
    use CommentableTrait;
    use StorageTrait;

    protected $guarded = ['id'];
    public $incrementing = false;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    function getNameAttribute($val)
    {
        return Str::ucfirst($val);
    }

    /**
     * Checks is if the authenticated user is using this module
     *
     * @return bool
     */
    function getUsedAttribute(): bool
    {
        if (!auth()->user()) return false;

        return (bool)$this->ministryModules()
            ->where('ministry_id', auth()->user()->id)
            ->active()
            ->count();
    }

    /**
     * Formats the description.
     *
     * @param $val
     * @return string
     */
    public function getDescriptionAttribute($val)
    {
        return Str::ucfirst($val);
    }

    /**
     * @inheritDoc
     */
    function filesDir()
    {
        return 'modules';
    }

    /**
     * @inheritDoc
     */
    function getFileName()
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
