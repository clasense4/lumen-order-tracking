<?php

namespace App\Helpers;

class ResponseHelpers
{
    public static function returnJson($status, $message)
    {
        $res = [
            "status" => $status,
            "message" => $message
        ];
        return $res;
    }

    public static function returnJsonData($status, $data, $msg)
    {
        $res = [
            "status" => $status,
            "data" => $data,
            "message" => $msg
        ];
        return $res;
    }

}

?>