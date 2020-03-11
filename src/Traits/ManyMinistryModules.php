<?php

namespace Faithgen\AppBuild\Traits\Relationships\Has;

use Faithgen\AppBuild\Models\MinistryModule;

trait ManyMinistryModules
{
    /**
     * Links the current object to many ministry modules
     *
     * @return mixed
     */
    public function ministryModules()
    {
        return $this->hasMany(MinistryModule::class);
    }
}
