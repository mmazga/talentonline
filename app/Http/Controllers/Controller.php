<?php

namespace App\Http\Controllers;

use App\Libraries\Codes\ResponseCodes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     * @param null $data
     * @param bool $success
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse(string $message, $data = null, bool $success = true, int $code = ResponseCodes::SUCCESS)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data'    => $data,
            'code'    => $code
        ], $code);
    }
}
