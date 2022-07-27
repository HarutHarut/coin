<?php

namespace App\Repositories;


use Illuminate\Http\JsonResponse;

class ResponseRepository
{
    const SUCCESS = 200;
    const NOTFOUND = 404;
    const BADREQUEST = 400;

    /**
     * @param array $data
     * @param string $message
     * @return JsonResponse
     */
    public static function badRequest(array $data = [], $message = 'Sorry Something went Wrong.'): JsonResponse
    {
        return self::error($data, $message, self::BADREQUEST);
    }

    /**
     * @param array $data
     * @param string $message
     * @return JsonResponse
     */
    public static function notFound(array $data = [], $message = 'Sorry, Resource not found.'): JsonResponse
    {
        return self::error($data, $message, self::NOTFOUND);
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public static function success(array $data = [], $message = 'Success', $status = self::SUCCESS): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * @param array $data
     * @param string $message
     * @param $status
     * @return JsonResponse
     */
    private static function error($data = [], $message = '', $status): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
