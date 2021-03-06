<?php

namespace Faithgen\AppBuild\Models;

use FaithGen\SDK\Models\UuidModel;

class BuildLog extends UuidModel
{
    protected $table = 'fg_build_logs';
    protected $guarded = ['id'];
    protected $hidden = [
        'build_id',
    ];

    /**
     * Links this log to a build.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function build()
    {
        return $this->belongsTo(Build::class);
    }
}
