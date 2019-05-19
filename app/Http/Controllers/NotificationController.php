<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Utility\NotificationRepository;
use App\Notification;
use DB;
use Carbon\Carbon;

class NotificationController extends Controller
{
	protected $notif;

	public function __construct(NotificationRepository $notificationRepository)
	{
		$this->notif = $notificationRepository;
	}

	public function index(){
		$userid = session()->get('userid');
		$role = session()->get('role');

		if(!session()->has('userid') || !session()->has('role')){
			return view('errors.notfound');
		}

		$notifications = $this->notif->getNotifbyID($role=='customer'?'CU':'EM', $userid);
		if($notifications!=null){
			if(count($notifications)>0){
				foreach ($notifications as $key => $value) {
					$a = Carbon::parse($value->created_at);
					$value->bedawaktu = $a->diffForHumans(Carbon::now());
				}
			}
		}

		return view('pages.account.notification', compact('notifications'));
	}

	
}
