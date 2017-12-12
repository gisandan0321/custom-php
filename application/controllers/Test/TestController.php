<?php

use App\Core\CoreController;
use App\Core\Request;

class TestController extends CoreController{
    
    public function __construct() {
        parent:: __construct();
    }
    
    public function Test(Request $request) {

    	$data = $request->validate([
    		'id'	=>	'numeric|required',
    		'name'	=>	'required'
    	]);

        $this->success($request->params());
    }
}