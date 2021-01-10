<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'priority_name' => $this->priority->name,
            'priority_id' => $this->priority->id,
            'status_name' => $this->status->name,
            'status_id' => $this->status->id,
            'expiration_date' => $this->expiration_date
        ];
    }

    /**
     * @inheritdoc
     */
    public function with($request): array
    {
        return [
            'status' => true
        ];
    }
}
