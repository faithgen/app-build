<?php

namespace Faithgen\AppBuild\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use InnoFlash\LaraStart\Helper;

class Build extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'version' => $this->version,
            'status' => $this->status,
            'dates' => [
                'created' => Helper::getDates($this->created_at),
                'updated' => Helper::getDates($this->updated_at),
            ],
            'logs_count' => $this->buildLogs()->count(),
        ];
    }
}
