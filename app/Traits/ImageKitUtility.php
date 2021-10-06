<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use ImageKit\ImageKit;

trait ImageKitUtility
{
    protected function uploadToImageKit($payload, $fileName, $folder, $height, $width, $isPath = null)
    {
        try {
            // dd($isPath);
            // $isPath ? $img = $payload : $img = $this->toBase64($payload, $width, $height);
            $img = $this->toBase64($payload, $width, $height);
            $toImageKit = $this->init();
            $uploadFile = $toImageKit->upload(array(
                'file' => $img,
                'fileName' => $fileName,
                "folder" => $folder,
            )); //code...
            return $uploadFile;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    private function toBase64($file, $width, $height)
    {
        if ($width && $height) {
            $base64 = Image::make($file)
                ->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('data-url');
        }
        $base64 = Image::make($file)
            ->encode('data-url');
        return $base64;
    }

    protected function deleteImage($fileId)
    {
        try {
            $toImageKit = $this->init();
            return $toImageKit->deleteFile($fileId);
        } catch (\Exception $e) {
            return $e;
        }
    }
    private function init()
    {
        return new ImageKit(
            env('IMAGE_KIT_PUBLIC'),
            env('IMAGE_KIT_PRIVATE'),
            env('IMAGE_KIT_URL')
        );
    }
}
