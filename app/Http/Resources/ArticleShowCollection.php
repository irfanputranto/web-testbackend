<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleShowCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            "id" => $this->id,
            "alias" => $this->alias,
            "title" => $this->title,
            "content" => $this->content,
            "image" => asset('storage/images/' . $this->image),
            "publish_at" => $this->publish_at,
            "author" => $this->name
        ];
    }
}
