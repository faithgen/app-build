<?php

namespace Faithgen\AppBuild\Models;

use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\ActiveTrait;
use FaithGen\SDK\Traits\Relationships\Belongs\BelongsToMinistryTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinistryModule extends UuidModel
{
    use BelongsToMinistryTrait;
    use ActiveTrait;

    public function scopeActive($query)
    {
        return $query->whereActive(true);
    }

    /**
     * Links this object to a module.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
