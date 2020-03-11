<?php

namespace Faithgen\AppBuild\Models;

use App\BuildLog;
use FaithGen\SDK\Models\UuidModel;
use FaithGen\SDK\Traits\Relationships\Belongs\BelongsToMinistryTrait;

class Build extends UuidModel
{
    use BelongsToMinistryTrait;

    protected $guarded = ['id'];
    protected $table = 'app_builds';

    /**
     * Links the current build to many logs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function buildLogs()
    {
        return $this->hasMany(BuildLog::class);
    }
}
