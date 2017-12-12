<?php

namespace App\Core;

class Loader {

	/**
	 * Loader Constructor
	 */
	public function __construct() {}

	/**
	 * Controller Loader
	 *
	 * @param string $file
	 */
	public static function controller($file = '') {
		if (empty($file)) {
			echo "Please specify file path";
			return;
		}

		if (!file_exists(APPLICATION . '/controllers/' . $file . PHP_EXT)) {
			echo "Invalid Controller Path.";
			return;
		}

		require APPLICATION . '/controllers/' . $file . PHP_EXT;
	}

	/**
	 * Model Loader
	 *
	 * @param string $file
	 */
	public static function model($file = '') {
		if (empty($file)) {
			echo "Please specify file path";
			return;
		}

		if (!file_exists(APPLICATION . '/models/' . $file . PHP_EXT)) {
			echo "Invalid Model Path.";
			return;
		}

		require APPLICATION . '/models/' . $file . PHP_EXT;
	}

	/**
	 * Controller Loader
	 *
	 * @param string $file
	 */
	public static function view($file = '') {
		if (empty($file)) {
			echo "Please specify file path";
			return;
		}

		if (!file_exists(PUBLIC_HTML . '/views/' . $file . PHP_EXT)) {
			echo "Invalid File Path.";
			return;
		}

		require PUBLIC_HTML . '/views/' . $file . PHP_EXT;
	}	

	/**
	 * Erro View Loader
	 *
	 * @param string $errorCode
	 */
	public static function error($errorCode = 0) {
		if (empty($errorCode)) {
			echo "Please specify error code.";
			return;
		}

		$errorCodes = [400, 401, 403, 404, 409, 500];

		if (!in_array($errorCode, $errorCodes)) {
		    echo "Invalid Error Code";
		}

		http_response_code($errorCode);

		require PUBLIC_HTML . '/error/' . $errorCode . PHP_EXT;
	}
}
