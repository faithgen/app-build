<?php

namespace Faithgen\AppBuild\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BuildLog extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
