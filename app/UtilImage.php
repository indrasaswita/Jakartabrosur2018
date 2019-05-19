<?php

	namespace App;

	public static class UtilImage{
		public static function sanitizeFilename($string, $force_lowercase = true, $anal = false)
		{
			$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
				"}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
				"â€”", "â€“", ",", "<", ".", ">", "/", "?");
			$clean = trim(str_replace($strip, "", strip_tags($string)));
			$clean = preg_replace('/\s+/', "-", $clean);
			$clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

			return ($force_lowercase) ?
				(function_exists('mb_strtolower')) ?
					mb_strtolower($clean, 'UTF-8') :
					strtolower($clean) :
				$clean;
		}
	}

	public static function createUniqueFilename( $filename, $extension )
	{
		//$full_size_dir = Config::get('images.full_size');
		$full_size_dir = public_path('images/original/');
		$full_image_path = $full_size_dir . $filename . '.' . $extension;

		if ( File::exists( $full_image_path ) )
		{
			// Generate token for image
			$imageToken = substr(sha1(mt_rand()), 0, 5);
			return $filename . '-' . $imageToken . '.' . $extension;
		}

		return $filename . '.' . $extension;
	}

?>