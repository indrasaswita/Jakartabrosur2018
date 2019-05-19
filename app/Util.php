<?php
namespace App;

public static class Util
{
	public static function error($data)
	{
		return ["data"=>$data, "status"=>"error"];
	}
	public static function success($data)
	{
		return ["data"=>$data, "status"=>"success"];
	}
}
?>