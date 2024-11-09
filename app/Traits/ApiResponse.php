<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function response($message, $data = null, $code = 200): JsonResponse
    {
        $response = ['message' => $message];
        if (!is_null($data)) {
            $response = array_merge( $data, $response);
        }
        return $this->jsonResponse($response, $code);
    }


    protected function responseMessage($message, $code = 200): JsonResponse
    {
        return $this->response($message, null, $code);
    }


    private function jsonResponse($data, $code = 200): JsonResponse
    {
        return response()->json($data, $code);
    }

}

