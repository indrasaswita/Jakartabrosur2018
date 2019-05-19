<?php
	
namespace App\Helpers;

class MathHelper{
	public static function ceil($input, $precision)
	{
		return floatval(ceil(floatval($input)/$precision)*$precision);
	}

	public static function round($input, $precision)
	{
		return floatval(round(floatval($input)/$precision)*$precision);
	}

	public static function floor($input, $precision)
	{
		return floatval(floor(floatval($input)/$precision)*$precision);
	}

	public static function quickRandom($length = 16)
	{
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}

	public static function numRandom($length = 16)
	{
		$pool = '0123456789';

		return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}

	public static function thseparator($input, $precision = 0){
		if(is_numeric($input)){
			return number_format($input, $precision, ',', '.');
		}else{
			return "non-number";
		}
	}

}
