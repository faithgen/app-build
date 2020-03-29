<?php

namespace Faithgen\AppBuild\Http\Resources;

use FaithGen\SDK\Helpers\ImageHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleDetails extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'used' => $this->used,
            'images' => $this->images->map(fn($image) => ImageHelper::getImage('modules', $image, config('faithgen-sdk.admin-server')))
                ->toArray()
        ]);
    }

}
