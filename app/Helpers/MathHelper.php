<?php
	
namespace App\Helpers;

class MathHelper{
	public static function ceil($input, $precision)
	{
		return floatval(ceil($input/$precision)*$precision);
	}

	public static function round($input, $precision)
	{
		return floatval(round($input/$precision)*$precision);
	}

	public static function floor($input, $precision)
	{
		return floatval(floor($input/$precision)*$precision);
	}
}
