<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

use function App\Helpers\checkImg;
use function App\Helpers\checkVideo;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($article) {
                return [
                    "id" => $article->idsArticle,
                    "alias" => $article->alias,
                    "title" => $article->title,
                    "content" => $article->content,
                    "image" => checkImg($article->image),
                    "video" => checkVideo($article->video),
                    "publish_at" => $article->publish_at,
                    "author" => $article->author
                ];
            }),
        ];
    }
}
