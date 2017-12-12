<?php

namespace App\Core;

class Validator {

	public static $errorMessage = [
		'required'		=>	' is required.',
		'numeric'		=>	' must be a number.',
		'alphanumeric'	=>	' must be alpha numeric.',
		'max'			=>	' must be at most ',
		'min'			=>	' must be at least',
		'int'			=>	' must be integer',
		'float'			=>	' must have a decimal point',
		'string'		=>	' must be a string'
	];

	/*
	 * Required
	 *
	 * @param string $data
	 * @return bool
	 */
	public static function required($data) {
		return (empty($data)) ? false : true;
	}

	/*
	 * Alpha Numeric
	 *
	 * @param string $data
	 * @return bool
	 */
	public static function alphanumeric($data) {
		return (ctype_alnum($data)) ? true : false;
	}	

	/*
	 * Numeric
	 *
	 * @param string $data
	 * @return bool
	 */
	public static function numeric($data) {
		return (is_numeric($data)) ? true : false;
	}

	/*
	 * Max
	 *
	 * @param string $data
	 * @param int $length
	 * @return bool
	 */
	public static function max($data, $length = 0) {
		return (strlen($data) > $length) ? false : true; 
	}

	/*
	 * Min
	 *
	 * @param string $data
	 * @param int $length
	 * @return bool
	 */
	public static function min($data, $length = 0) {
		return (strlen($data) < $length) ? false : true; 
	}

	/*
	 * String
	 *
	 * @param string $data
	 * @return bool
	 */
	public static function string($data) {
		return (is_string($data)) ? true : false;
	}

	/*
	 * Int
	 *
	 * @param string $data
	 * @return bool
	 */
	public static function int($data) {
		return (is_integer($data)) ?true : false;
	}

	/*
	 * Float
	 *
	 * @param string $data
	 * @return bool
	 */
	public static function float($data) {
		return (is_float($data)) ? true : false;
	}
}
