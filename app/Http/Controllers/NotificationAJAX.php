<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Utility\NotificationRepository;
use App\Notification;
use DB;
use Carbon\Carbon;
use App\Logic\Curl\OneSignal;
use App\Logic\Utility\Helper;

class NotificationAJAX extends Controller
{
	protected $notif;

	public function __construct(NotificationRepository $notificationRepository)
	{
		$this->notif = $notificationRepository;
	}

	public function setviewed($id){
		$userid = session()->get('userid');
		$role = session()->get('role');

		if(!session()->has('userid') || !session()->has('role')){
			return "Restricted";
		}

		return $this->notif->viewNotifbyID($role=='customer'?'CU':'EM', $userid, $id);
	}

	public function sendtestnotif(){
		$text = 'ID: 12, JUMLAH 500 lembar, JUDUL Cetakan Harus Jadi.';
		$title = Helper::getRealIpAddr();
		$notif = new OneSignal();
		$result = $notif->sendMessage($title, $text);
	}

	

}
