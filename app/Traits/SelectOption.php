<?php

namespace App\Traits;

trait SelectOption
{
    private function selectOption($collection)
    {
        $select = [];
        foreach ($collection as $data) {
            $select[$data->id] = $data->name;
        }
        return $select;
    }
}