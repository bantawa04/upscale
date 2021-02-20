<?php 
namespace App\Traits;
use App\Link;
trait MetaTag
{
    private function metaTag($first, $second)
    {
        $data  = Link::where('para_1', $first)->where('para_2', $second)->firstOrFail();
        return $data;
    }
}