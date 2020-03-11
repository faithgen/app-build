<?php

namespace Faithgen\AppBuild\Policies;

use App\Models\Ministry;
use Faithgen\AppBuild\Models\Build;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the build.
     *
     * @param Ministry $user
     * @param Build $build
     * @return mixed
     */
    public function view(Ministry $user, Build $build)
    {
        return $user->id === $build->ministry_id;
    }

    /**
     * Determine whether the user can create builds.
     *
     * @param Ministry $user
     * @return mixed
     */
    public function create(Ministry $user)
    {
        //
    }

    /**
     * Determine whether the user can update the build.
     *
     * @param Ministry $user
     * @param Build $build
     * @return mixed
     */
    public function update(Ministry $user, Build $build)
    {
        //
    }

    /**
     * Determine whether the user can delete the build.
     *
     * @param Ministry $user
     * @param Build $build
     * @return mixed
     */
    public function delete(Ministry $user, Build $build)
    {
        //
    }
}
