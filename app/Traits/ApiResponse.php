<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function response($message, $data = null, $code = 200):jsonResponse
    {
        if (!is_null($data)) {
            $response = array_merge( ['message'=>$message],['data'=>$data] );
        }else{
            return $this->jsonResponse($message);
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

    protected function showOne($instance, $resource, $message = 'success', $code = 200): JsonResponse
    {
        return $this->response($message, new $resource($instance));
    }

    protected function showCollection($data, $resource, $message = 'success', $code = 200)
    {
        $response = $resource::collection($data);
        return $this->response($message, $response);
    }
    protected function paginationResponse($data,$resource, $message = 'success', $code = 200)
    {
        $response = $resource::collection($data->itemsOnly());
        $response=array_merge(['items'=>$response],['pagination'=>$data->getPagination()]);
        return $this->response($message,$response);
    }


}

