<?php

namespace App\Helpers;

class ResponseHelpers
{
    public static function returnJson($status, $message = null, $data = null)
    {
        $res['status'] = $status;
        if (!empty($data)) {
            $res['data'] = $data;
        }
        if (!empty($message)) {
            $res['message'] = $message;
        }

        return $res;
    }
}

?>