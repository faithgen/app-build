<?php

namespace Faithgen\AppBuild\Traits;

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
