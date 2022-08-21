<?php

/**
 * Format response.
 */
class ResponseFormatter
{
    /**
     * API Response
     *
     * @var array
     */
    protected static $response = [
        'metadata' => [
            'path' => null,
            'code' => 200,
            'status' => 'success',
            'message' => null,
        ],
        'pagination' => [
            'current_page' => 1,
            'current_item' => 1,
            'total_page' => 1,
            'total_item' => 1,
        ],
        'data' => null,
    ];

    /**
     * Give success response.
     */
    public static function success($path = null, $data = null, $message = null, $current_page = 1, $current_item = 1, $total_page = 1, $total_item = 1)
    {
        self::$response['metadata']['path'] = $path;
        self::$response['metadata']['message'] = $message;
        self::$response['pagination']['current_page'] = $current_page;
        self::$response['pagination']['current_item'] = $current_item;
        self::$response['pagination']['total_page'] = $total_page;
        self::$response['pagination']['total_item'] = $total_item;
        self::$response['data'] = $data;

        return json_encode(self::$response, self::$response['metadata']['code']);
    }

    /**
     * Give created response.
     */
    public static function created($path = null, $data = null, $message = null, $current_page = 1, $current_item = 1, $total_page = 1, $total_item = 1)
    {
        self::$response['metadata']['path'] = $path;
        self::$response['metadata']['message'] = $message;
        // self::$response['pagination']['current_page'] = $current_page;
        // self::$response['pagination']['current_item'] = $current_item;
        // self::$response['pagination']['total_page'] = $total_page;
        // self::$response['pagination']['total_item'] = $total_item;
        self::$response['data'] = $data;

        return json_encode(self::$response, self::$response['metadata']['code']);
    }

    /**
     * Give error response.
     */
    public static function error($path = null, $data = null, $message = null, $code = 400)
    {
        self::$response['metadata']['path'] = $path;
        self::$response['metadata']['code'] = $code;
        self::$response['metadata']['status'] = 'error';
        self::$response['metadata']['message'] = $message;
        self::$response['data'] = $data;

        return json_encode(self::$response, self::$response['metadata']['code']);
    }
}
