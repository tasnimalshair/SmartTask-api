<?php

namespace App\Http\Traits;

trait ApiResponse
{

    public function successMessage($message, $code = 200, $data = null)
    {
        return response()->json([
            'status' => 'true',
            'message' => $message,
            'http_code' => $code
        ]);
    }

    public function success($message, $code = 200, $data = null)
    {
        return response()->json([
            'status' => [
                'status' => 'true',
                'message' => $message,
                'http_code' => $code
            ],
            'data' => $data
        ]);
    }

    public function error($message, $code = 500)
    {
        return response()->json([
            'status' => 'false',
            'message' => $message,
            'http_code' => $code
        ]);
    }
}
