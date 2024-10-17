<?php

namespace App\Helper;

class Response
{
    public static function success($data = [], $message = '', $code = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ], $code);
    }

    public static function error($error = [],$message = '', $code = 400)
    {
        return response()->json([
            'error' => $error,
            'message' => $message
        ], $code);
    }
}