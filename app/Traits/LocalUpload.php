<?php

namespace App\Traits;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

trait LocalUpload
{
    protected function  uploadThumbnail($file, $localPath,$type, $width, $height)
    {
		$fileName = $type.$file->getClientOriginalName().'_'.time().'.'.$file->getClientOriginalExtension();

        $thumbPath = $localPath. $fileName;
        
		Image::make($file)
		->resize($width, $height, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		})
		->save($thumbPath);

		ImageOptimizer::optimize($thumbPath);
		return $thumbPath;
    } 
}