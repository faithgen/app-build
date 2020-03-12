<?php

namespace Faithgen\AppBuild\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use InnoFlash\LaraStart\Http\Helper;

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
        return [
            'id' => $this->id,
            'task' => $this->task,
            'result' => $this->result,
            'success' => (bool) $this->success,
            'logged_on' => Helper::getDates($this->created_at)
        ];
    }
}
