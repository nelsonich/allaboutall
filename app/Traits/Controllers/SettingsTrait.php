<?php

namespace App\Traits\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait SettingsTrait {
    /**
     * Upload files.
     *
     * @param string $path
     * @param UploadedFile|UploadedFile[]|array|null $file
     *
     * @return array
     */

    public static function uploadFiles(string $path, $file): array
    {
        $fileNames = [];

        if (!$file) {
            return false;
        }

        $files = [];
        if (!is_array($file)) {
            $files = [$file];
        } else {
            $files = $file;
        }

        foreach ($files as $file) {
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path($path), $fileName);
            $fileNames[] = $fileName;
        }

        return $fileNames;
    }

    /**
     * Remove files.
     *
     * @param string $path
     * @param string $fileName
     *
     * @return array
     */

    public static function removeFiles(string $path, $fileName)
    {
        if (!$fileName) {
            return false;
        }

        $files = [];
        if (!is_array($fileName)) {
            $files = [$fileName];
        } else {
            $files = $fileName;
        }

        foreach ($files as $file) {
            File::delete(public_path($path . DIRECTORY_SEPARATOR . $file));
        }
    }
}
