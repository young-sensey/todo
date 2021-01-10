<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * @inheritdoc
     */
    public function with($request)
    {
        return [
            'status' => true
        ];
    }
}
