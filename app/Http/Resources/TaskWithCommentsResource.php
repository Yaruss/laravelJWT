<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskWithCommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'completed' => $this->completed,
            'created_at' => $this->created_at->format('U'),
            'completed_date' => is_null($this->completed_date) ? 0 : $this->completed_date->format('U'),
            'comments' => CommentsResource::collection($this->comments)
        ];
    }
}
