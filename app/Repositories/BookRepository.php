<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BookRepository extends BaseRepository
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function addMedia($id, $pathFile)
    {
        $data = $this->model->findOrFail($id);
        $data->addMedia(storage_path('app/public/' . $pathFile))->toMediaCollection();
        return $data;

    }

    public function deleteMedia($id, $mediaId)
    {
        $media = Media::where('uuid', $mediaId)->first();
        if (!$media) {
            throw new \Exception('Media Id Is Not Found!');
        }
        $data = $this->model->findOrFail($id);
        $data->deleteMedia($media->id);
        return true;
    }
}
