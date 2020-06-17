<?php

namespace Faithgen\AppBuild\Services;

use Faithgen\AppBuild\Models\MinistryModule;
use Faithgen\AppBuild\Models\Module;
use InnoFlash\LaraStart\Services\CRUDServices;

class ModuleService extends CRUDServices
{
    protected Module $module;

    public function __construct()
    {
        $this->module = app(Module::class);

        if (request()->has('module_id')) {
            $this->module = Module::findOrFail(request('module_id'));
        }

        if (request()->route()->hasParameter('module')) {
            $this->module = $this->module->resolveRouteBinding(request()->route('module'));
        }
    }

    /**
     * Retrieves an instance of module.
     *
     * @return \Faithgen\AppBuild\Models\Module
     */
    public function getModule(): Module
    {
        return $this->module;
    }

    /**
     * Makes a list of fields that you do not want to be sent
     * to the create or update methods.
     * Its mainly the fields that you do not have in the messages table.
     *
     * @return array
     */
    public function getUnsetFields(): array
    {
        return ['module_id'];
    }

    /**
     * Deactivates all the modules the current logged in ministry is using.
     *
     * @return mixed
     */
    public function invalidateModules()
    {
        return MinistryModule::where('ministry_id', auth()->user()->id)
            ->update([
                'active' => false,
            ]);
    }

    /**
     * This assigns modules to the ministry.
     *
     * @param  array  $modules
     *
     * @return bool if the assignment worked or not
     */
    public function addModules(array $modules): bool
    {
        try {
            foreach ($modules as $module) {
                $params = [
                    'module_id'   => $module,
                    'ministry_id' => auth()->user()->id,
                ];
                $this->getModel()
                    ->ministryModules()
                    ->updateOrCreate($params, array_merge($params, ['active' => true]));
            }

            return true;
        } catch (\Exception $e) {
            abort(500, $e->getMessage());

            return false;
        }
    }
}
