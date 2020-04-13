<?php

namespace Faithgen\AppBuild\Observers;

use Faithgen\AppBuild\Models\Module;
use FaithGen\SDK\Traits\FileTraits;

class ModuleObserver
{
    use FileTraits;

    /**
     * Handle the module "created" event.
     *
     * @param Module $module
     * @return void
     */
    public function created(Module $module)
    {
        //
    }

    /**
     * Handle the module "updated" event.
     *
     * @param Module $module
     * @return void
     */
    public function updated(Module $module)
    {
        //
    }

    /**
     * Handle the module "deleted" event.
     *
     * @param Module $module
     * @return void
     */
    public function deleted(Module $module)
    {
        if ($module->images) {
            $this->deleteFiles($module);
        }
    }
}
