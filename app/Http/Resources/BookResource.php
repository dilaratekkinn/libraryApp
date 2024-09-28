<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'subtitle' => $this->subtitle,
            'summary' => $this->summary,
            'published_year' => $this->published_year,
            'categories' => CategoryResource::collection($this->categories)
        ];
        if ($request->route()->getName() != 'author.show') {
            $data['author'] =   new AuthorResource($this->getAuthor);
        }
        if ($request->route()->getName() == 'book.show') {
            $data['libraries'] = LibraryResource::collection($this->libraries);
            $data['medias'] = BookMediaResource::collection($this->getMedia());

        }
        return $data;
    }
}
