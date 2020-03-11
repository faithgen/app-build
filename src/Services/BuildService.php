<?php

namespace Faithgen\AppBuild\Services;

use Faithgen\AppBuild\Models\Build;
use InnoFlash\LaraStart\Services\CRUDServices;
use Illuminate\Database\Eloquent\Model as ParentModel;

class BuildService extends CRUDServices
{
    private Build $build;

    public function __construct(Build $build)
    {
        if (request()->has('build_id'))
            $this->build = Build::findOrFail(request('build_id'));
        else $this->build = $build;
    }

    /**
     * Retrieves an instance of build
     */
    public function getBuild(): Build
    {
        return $this->build;
    }

    /**
     * Makes a list of fields that you do not want to be sent
     * to the create or update methods
     * Its mainly the fields that you do not have in the builds table
     */
    public function getUnsetFields()
    {
        return ['build_id'];
    }

    /**
     * This returns the model found in the constructor
     * or an instance of the class if no build is found
     */
    public function getModel()
    {
        return $this->getBuild();
    }

    /**
     * Attaches a parent to the current build
     * You can delete this if you do not intent to create builds from parent relationships
     */
    public function getParentRelationship()
    {
        return [
            ParentModel::class,
            'relationshipName',
        ];
    }
}
