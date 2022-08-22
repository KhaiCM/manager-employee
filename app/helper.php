<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('defineResponse')) {
    /**
     * Define response message
     *
     * @param $message
     * @param $status
     * @param $data
     * @param $other
     * @return JsonResponse
     */
    function defineResponse($message, $status = 200, $data = [], $other = []): JsonResponse
    {
        $responses = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $responses['data'] = $data;
        }
        
        return response()->json(
            array_merge($responses, $other),
            $status
        );
    }
}
