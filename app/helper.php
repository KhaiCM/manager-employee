<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('responseError')) {
    /**
     * Define response message error
     *
     * @param $message
     * @param $status
     * @return JsonResponse
     */
    function responseError($message, $status, $other = []): JsonResponse
    {
        return response()->json(array_merge([
            'status' => $status,
            'message' => $message,
            'success' => false,
        ], $other), $status);
    }
}

if (!function_exists('defineResponse')) {
    /**
     * Define response
     *
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    function defineResponse($message, $data = []): JsonResponse
    {
        $responses = [
            'message' => $message,
        ];

        if (!empty($data)) {
            $responses['data'] = $data;
        }

        return response()->json($responses);
    }
}
