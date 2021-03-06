<?php

namespace Faithgen\AppBuild\Services;

use Faithgen\AppBuild\Models\Build;
use InnoFlash\LaraStart\Services\CRUDServices;

class BuildService extends CRUDServices
{
    protected Build $build;

    public function __construct()
    {
        $this->build = app(Build::class);

        $buildId = request()->route('build') ?? request('build_id');

        if ($buildId) {
            $this->build = $this->build->resolveRouteBinding($buildId);
        }
    }

    /**
     * Retrieves an instance of build.
     *
     * @return \Faithgen\AppBuild\Models\Build
     */
    public function getBuild(): Build
    {
        return $this->build;
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
        return ['build_id'];
    }

    /**
     * Attaches a parent to the current build
     * You can delete this if you do not intent to create builds from parent relationships.
     */
    public function getParentRelationship()
    {
        return auth()->user()->builds();
    }
}
