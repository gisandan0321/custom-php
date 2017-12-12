<?php

namespace App\Core; 

use App\Core\Loader;
use App\Core\Request;

class Route {

	public static $routes = [];
	protected $uri;

	/*
	 * Route Constructor
	 */
	public function __construct() {
		$this->setUri();
	}

	/*
	 * Get Current URI
	 *
	 */
	public function setUri() {
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) {
        	$uri = substr($uri, 0, strpos($uri, '?'));
        }
        $this->uri = trim($uri, '/');
	}

	/*
	 * Get Request Method Type
	 *
	 * @return string
	 */
	public function getMethod() {
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	/*
	 * Return Saved Currrent URI
	 *
	 * @return string
	 */
	public function getUri() {
		return $this->uri;
	}

	/*
	 * Check if route exist
	 *
	 * @param string $uri
	 * @return mixed
	 */
	public function checkRoute($uri = '') {
		$routes = Static::$routes[$this->getMethod()];
		$staticRoutes = [];
		$dynamicRoutes = [];

		foreach ($routes as $key => $value) {
			if (is_int(strpos($key, '{'))) {
				$dynamicRoutes[$key] = $value;
			} else {
				$staticRoutes[$key] = $value;
			}
		}

		$staticRoute = array_key_exists($this->getUri(), $staticRoutes);

		if ($staticRoute) {
			return $staticRoutes[$this->getUri()];
		}


		foreach ($dynamicRoutes as $key => $value) {
			$uriData = explode('/', $this->getUri());
			$routeData = explode('/', $key);

			$uriLength = count($uriData);
			$routeLength = count($routeData);

			if ($uriLength === $routeLength && $uriData[0] === $routeData[0]) {
				$method = strtoupper($this->getMethod());
				$this->registerParam($routeData, $uriData);
				return $value;
			}
		}

		return false;
	}

	/**
	 * Register URI as HTTP Parameters
	 *
	 * @param array $routeData
	 * @param array $uriData
	 */
	public function registerParam($routeData = [], $uriData = []) {
		for ($i = 0; $i < count($routeData); $i++) {
			if (is_int(strpos($routeData[$i], '{'))) {
				$param = preg_replace('/[^A-Za-z0-9\-]/', '', $routeData[$i]);
				$_REQUEST[$param] = $uriData[$i];
			}
		}
	}

	/*
	 * Store Get Routes 
	 */
 	public static function get($route = '', $controller = '') {
 		Static::$routes['get'][$route] = $controller;
 	}  

 	/*
	 * Store Post Routes 
	 */
 	public static function post($route = '', $controller = '') {
 		Static::$routes['post'][$route] = $controller;
 	}

 	/*
	 * Store Put Routes 
	 */
 	public static function put($route = '', $controller = '') {
 		Static::$routes['put'][$route] = $controller;
 	}

 	/*
	 * Store Delete Routes 
	 */
 	public static function delete($route = '', $controller = '') {
 		Static::$routes['delete'][$route] = $controller;
 	}

 	/*
 	 * Store Patch Routes
 	 */
 	public static function patch($route = '', $controller = '') {
 		Static::$routes['patch'][$route] = $controller;
 	}

 	/*
 	 * Redirect Current Route
 	 */
 	public function direct() {
 		// Check if no URI
 		if (empty($this->getUri()) || $this->getUri() == '/') {
 			echo 'Default Route.';
 			return;
 		}

 		// Check if route exist
 		$route = $this->checkRoute($this->getUri());
 		if ($route) {
 			$controllerPath = explode('@', $route);

 			Loader::controller($controllerPath[0]);

 			$controllerUri = explode('/',$controllerPath[0]);
 			$controller = $controllerUri[count($controllerUri) - 1];

 			$controllerInstance = new $controller();

 			$method = 'index';

 			if (count($controllerPath) > 1) {
 				$method = $controllerPath[count($controllerPath) - 1];
 			}

 			return $controllerInstance->$method(new Request());
 		} else {
 			Loader::error(404);
 		}
 	}
}

require APPLICATION . '/routes/api.php';

$route = new Route();
$route->direct();
