<?php

namespace Faithgen\AppBuild\Models;

use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\Relationships\Belongs\BelongsToMinistryTrait;

class Build extends UuidModel
{
    use BelongsToMinistryTrait;

    protected $guarded = ['id'];
    protected $table = 'fg_app_builds';

    /**
     * Links the current build to many logs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildLogs()
    {
        return $this->hasMany(BuildLog::class);
    }
}
