<?php

namespace Faithgen\AppBuild\Models;

use FaithGen\SDK\Models\UuidModel;

class BuildLog extends UuidModel
{
    protected $guarded = ['id'];

    /**
     * Links this log to a build.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function build()
    {
        return $this->belongsTo(Build::class);
    }
}
