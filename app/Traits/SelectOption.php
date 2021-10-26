<?php

namespace App\Traits;

trait SelectOption
{
    private function selectOption($collection)
    {
        $select = [];
        foreach ($collection as $data) {
            if ($data->name) {
                $select[$data->id] = $data->name;
            }
            if ($data->title) {
                $select[$data->id] = $data->title;# code...
            }
            
        }
        return $select;
    }
}