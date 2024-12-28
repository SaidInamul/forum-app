<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\DiscussionResource;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'body' => $this->body,
            'body_markdown' => app(MarkdownRenderer::class)->toHtml($this->body),
            'body_preview' => Str::limit($this->body, 200),
            'user' => PublicUserResource::make($this->whenLoaded('user')),
            'discussion' => DiscussionResource::make($this->whenLoaded('discussion')),
            'created_at' => DateTimeResource::make($this->created_at),
            'user_can' => [
                'update' => auth()->user()->can('update', $this->resource)
            ]
        ];
    }
}
