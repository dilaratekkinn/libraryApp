<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'bio'=>$this->bio
        ];
        if ($request->route()->getName() == 'author.show') {
            $data['books'] = BookResource::collection($this->getBooksAuthor);

        }
        return $data;
    }
}
