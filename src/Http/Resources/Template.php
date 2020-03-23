<?php

namespace Faithgen\AppBuild\Http\Resources;

use FaithGen\SDK\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'images' => $this->images->map(fn($image) => $this->getAvatar($image))->toArray()
        ]);
    }


    private function getAvatar(Image $image): array
    {
        return [
            'original' => config('faithgen-build-config.parant_server') . 'storage/templates/original/' . $image->name
        ];
    }
}
