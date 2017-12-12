<?php

use App\Core\CoreController;
use App\Core\Request;

class TaskController extends CoreController {
    
    public function __construct() {
        parent:: __construct();
    }
    
    public function index(Request $request) {
    	$this->success($request->params());
    }
}
