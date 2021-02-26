<?php

namespace App\Traits;
use ImageKit\ImageKit;
trait UploadImageKit
{
    private function uploadToImageKit($fileLink, $fileName)
    {    
        $imageKit = new ImageKit(
            "public_xee63DZd+a56dsNTMWm7zBJEkvA=",
            "private_n+iBK4c7XBx9Bdvc73hRQquDo6E=",
            "https://ik.imagekit.io/azq00gyzbcp"
        );

        $uploadFile = $imageKit->upload(array(
            'file' => $fileLink,
            'fileName' => $fileName,
            "folder" => "test",
        ));

        return $uploadFile;
    }
}