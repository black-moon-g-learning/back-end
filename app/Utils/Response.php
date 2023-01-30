<?php
namespace App\Utils;

trait Response
{
    /**
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess(int $status = 200)
    {
        return $this->response([], 'success', $status);
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $status
     */
    public function response(array $data = [], string $message = "", int $status = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * @param array $data
     * @param int $status
     * @return Response|\Illuminate\Http\JsonResponse
     */
    public function responseSuccessWithData(array $data = [], int $status = 200)
    {
        return $this->response($data, 'success', $status);
    }

    /**
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError(int $status = 400)
    {
        return $this->response([], 'error', $status);
    }

    /**
     * @param array $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseErrorWithData(array $data = [], int $status = 400)
    {
        return $this->response($data, 'error', $status);
    }
}
