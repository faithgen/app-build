<?php

namespace Faithgen\AppBuild\Http\Resources;

use FaithGen\SDK\Helpers\ImageHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use InnoFlash\LaraStart\Helper;

class Template extends JsonResource
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
            'created_at' => Helper::getDates($this->created_at),
            'images' => $this->images->map(fn($image) => ImageHelper::getImage('templates', $image, config('faithgen-sdk.admin-server')))->toArray()
        ]);
    }
}
