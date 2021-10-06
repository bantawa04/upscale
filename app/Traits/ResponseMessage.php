<?php
 namespace App\Traits;

 trait ResponseMessage {

    protected function onSuccess($id) {
        return [
            'id' => $id,
            'message' => 'Item deleted sucessfully',
            'type' => 'success'
        ];
    }

    protected function onError($error) {
        return [
            'type' => 'error',
            'message' => "Item cannot be deleted. \r\n".$error->getMessage()
        ];
    }
 }