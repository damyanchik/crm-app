<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class PhotoHelper
{
    public static function deletePreviousPhoto(string $photoPath): void
    {
        $previousPhotoPath = 'public/' . $photoPath;

        if (Storage::disk('local')->exists($previousPhotoPath)) {
            Storage::disk('local')->delete($previousPhotoPath);
        }
    }
}
