<?php

namespace App\Logic\Curl;


define('APP_ID', 'a64fd1d6-473a-4181-9f27-b14bc0bdd2d7');
define('API_KEY', 'YWQ2YTBiZDItOTExNS00ZmY0LTlkMWQtY2EyNzU5ZWM2NWZm');
define('PLAYER_ID_BOY', '7e9a4edb-5567-4505-9cbe-435cbeabce86');

class OneSignal {

	protected $segments;

	function __construct(){
		$segments = 'Admin Users';
	}

	public function setSegment($value){
		//value harus berupa array
		if (is_array($value) or ($value instanceof Traversable)){
			$this->segments = $value;
		}else{
			return "INPUT MUST BE an array";
		}
	}

	public function sendMessage($title, $message, $recipients = array(PLAYER_ID_BOY)){
		// $recipients as an array
		$content = 
			array(
				"en" => $message
				);
		$heading = 
		array(
			"en" => $title
			);

		$fields = array(
				'app_id' => APP_ID,
				//'included_segments' => array('Admin Users'),
				'include_player_ids'=> $recipients, //array(PLAYER_ID_BOY),
				'data' => array("foo" => "bar"),
				'large_icon' =>"ic_launcher_round.png",
				'contents' => $content,
				'headings' => $heading
		);

		$fields = json_encode($fields);
		//print("\nJSON sent:\n");
		//print($fields);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
			'Authorization: Basic '.API_KEY));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}
}

?>