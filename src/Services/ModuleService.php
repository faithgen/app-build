<?php

namespace Faithgen\AppBuild\Services;

use Faithgen\AppBuild\Models\MinistryModule;
use Faithgen\AppBuild\Models\Module;
use Illuminate\Database\Eloquent\Model as ParentModel;
use InnoFlash\LaraStart\Services\CRUDServices;

class ModuleService extends CRUDServices
{
    private Module $module;

    public function __construct(Module $module)
    {
        if (request()->has('module_id'))
            $this->module = Module::findOrFail(request('module_id'));
        else $this->module = $module;
    }

    /**
     * Retrives an instance of module
     */
    public function getModule(): Module
    {
        return $this->module;
    }

    /**
     * Makes a list of fields that you do not want to be sent
     * to the create or update methods
     * Its mainly the fields that you do not have in the modules table
     */
    public function getUnsetFields()
    {
        return ['module_id'];
    }

    /**
     * This returns the model found in the constructor
     * or an instance of the class if no module is found
     */
    public function getModel()
    {
        return $this->getModule();
    }

    /**
     * Attaches a parent to the current module
     * You can delete this if you do not intent to create modules from parent relationships
     */
    public function getParentRelationship()
    {
        return [
            ParentModel::class,
            'relationshipName',
        ];
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
            'active' => false
        ]);
    }

    /**
     * This assigns modules to the ministry
     *
     * @param array $modules
     * @return bool if the assignment worked or not
     */
    public function addModules(array $modules): bool
    {
        try {
            foreach ($modules as $module) {
                $params = [
                    'module_id' => $module,
                    'ministry_id' => auth()->user()->id
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