<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\TopicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'is_pinned' => $this->isPinned(),
            'topic' => TopicResource::make($this->whenLoaded('topic'))
        ];
    }
}
