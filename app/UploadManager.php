<?php

namespace App;
use Image;
use ImageOptimizer;
use File;

use Illuminate\Database\Eloquent\Model;

class UploadManager extends Model
{
    public static function  uploadImage($file, $path, $thumb, $width=null, $height=null)
    {
        $filename = md5($file->getClientOriginalName().time()) .'.'. $file->getClientOriginalExtension();
        
		$path = $path . "car_" . $filename;
        $thumb = $thumb ."car_thumb_". $filename;
        
		Image::make($file)
		->resize($width, $height, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		})
		->save($path);
		Image::make($file)->fit(375,563)->save($thumb);
        
		ImageOptimizer::optimize($path);
		ImageOptimizer::optimize($thumb);
		return array($path, $thumb);
    } 
    
	public static function  uploadImageFull($file, $path, $thumb)
	{
        $filename = md5($file->getClientOriginalName().time()) .'.'. $file->getClientOriginalExtension();
        
		$path = $path ."med_". $filename;
        $thumb = $thumb ."med_thumb_". $filename;
        
		Image::make($file)->save($path);
		Image::make($file)->resize(286,180)->save($thumb);
        
		ImageOptimizer::optimize($path);
		ImageOptimizer::optimize($thumb);
		return array($path, $thumb);
	}    
	
	public  static function  fromMedia($image,$width=null,$height=null, $prefix=null)
	{
		$filename = $prefix.md5(now().basename($image)).'.'.pathinfo($image, PATHINFO_EXTENSION);
		$location = "img/".$filename;
		Image::make($image)->fit($width, $height, function ($constraint) {
			$constraint->upsize();
		})->save($location);
		ImageOptimizer::optimize($location);
		return $location;
	} 	
}
