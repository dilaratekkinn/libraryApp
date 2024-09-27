<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookVersionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'name' => $this['name'],
            'subtitle' => $this['subtitle'],
            'author_id' => $this['author_id'],
            'summary' => $this['summary'],
            'published_year' => $this['published_year'],
            'user_id' => $this['user_id'],
        ];
        return $data;
    }
}
