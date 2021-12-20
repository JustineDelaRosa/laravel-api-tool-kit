<?php

namespace Essa\APIToolKit;

use Illuminate\Support\Facades\Storage;

class MediaHelper
{
    /**
     * @param      $image              [ image]
     * @param      $path
     * @param null $old_image          [image path] [delete old image if exist]
     * @param null $with_original_name if want to save image with its original data
     * @return string [image full path after being moved]
     */
    public static function uploadImage($image, $path, $old_image = null, $with_original_name = null): string
    {
        if (!is_null($old_image)) {
            self::deleteImage($old_image);
        }

        if (!is_null($with_original_name)) {

            return Storage::putFileAs($path, $image, $image->getClientOriginalName());
        }

        return $image->store('/' . $path);
    }


    /**
     * upload multiple images
     * @param array $images
     * @param string $path
     * @param bool $with_original_names
     * @return array
     */
    public static function uploadMultiple(array $images, string $path, bool $with_original_names = false): array
    {
        $images_names = [];

        foreach ($images as $image) {
            $images_names[] = self::uploadImage($image, $path, $with_original_names);
        }

        return $images_names;
    }

    /**
     * [deleteImage description]
     * @param  [string] $image [image path to be deleted]
     */
    public static function deleteImage($image)
    {
        if (Storage::exists($image)) {
            Storage::delete($image);
        }
    }
}
