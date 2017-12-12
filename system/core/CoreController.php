<?php

namespace App\Core;

use App\Core\Request;

abstract class CoreController {
   
    public $request;

    /**
     * CoreController Constructor
     */
    public function __construct() {
        $this->request = new Request();
    }

    /**
     * Success - return success
     *
     * @param array $data
     * @param string $message
     */
    public function success($data = [], $message = '') {
        $return = [
            'data'      => $data,
            'err_msg'   => ($message) ? $message : 'Success'
        ];

        $this->response($data, 200);
    }
    
    /**
     * Response
     *
     * @param array $data
     * @param int $errorCode
     */
    public function response($data = [], $errorCode = null) {
        http_response_code($errorCode);
        echo json_encode($data);
    }
}
