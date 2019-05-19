<?php

namespace App\Logic\Utility;

use App\Notification;
use DB;

class NotificationRepository
{
	public function getNotifCount($owner, $userid){
		$item = $this->getNotifbyID($owner, $userid);
		$count = 0;
		if(count($item)>0)
			$count = count($item);
		return $count;
	}

	public function viewNotifbyID($owner, $userid, $notifid){
		if($userid == "") {
			$userid = null;
		}
		$item = Notification::where('ownerID', $userid)
				->where('id', $notifid)
				->where('owner', $owner)
				->first();

		if($item != null){
			if($item['viewed']){
				return "failed";
			}else{
				$item->viewed = 1;
				$item->save();
				return "success";
			}
		}else{
			return "not found";
		}
	}

	public function getNotifbyID($owner, $userid){
  	if($userid == ""){
  		$item = Notification::where('ownerID', NULL)
  				->orderBy('id', 'DESC')
  				->get();
  	}else{
  		if($owner == 'EM'){

				$item2 = Notification::where('owner', $owner)
						->with('employee')
	  				->where('ownerID', NULL)
	  				->orderBy('id', 'DESC')
	  				->get();

	  		$item = Notification::where('owner', $owner)
						->with('employee')
	  				->where('ownerID', $userid)
	  				->orderBy('id', 'DESC')
	  				->get();

	  		$item = $item2->merge($item);

			}else if($owner == 'CU'){

				$item2 = Notification::where('owner', $owner)
						->with('customer')
	  				->where('ownerID', NULL)
	  				->orderBy('id', 'DESC')
	  				->get();

				$item = Notification::where('owner', $owner)
						->with('customer')
	  				->where('ownerID', $userid)
	  				->orderBy('id', 'DESC')
	  				->get();

	  		$item = $item2->merge($item);

			}else{
				return "ERROR INPUT";
			}

  	}
		return $item;
  }
}

