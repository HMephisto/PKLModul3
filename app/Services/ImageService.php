<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function saveImage($file)
    {
        return Storage::disk('public')->put('images', $file);
    }

    public function editImage($oldFile, $newFile)
    {
        if ($this->deleteImage($oldFile)) {
            return $this->saveImage($newFile);
        }
        return false;
    }

    public function deleteImage($filename)
    {
        return Storage::delete($filename);
    }
}
