<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Utility\NotificationRepository;
use App\Notification;
use DB;

class NotificationAPI extends Controller
{
	protected $notif;

	public function __construct(NotificationRepository $notificationRepository)
	{
		$this->notif = $notificationRepository;
	}

  public function employeeall($id){
  	return $this->notif->getNotifCount('EM', $id);
  }

  public function customerall($id){
  	return $this->notif->getNotifCount('CU', $id);
  }

  public function all(){
  	return $this->notif->getNotifCount('', 0);
  }
}
