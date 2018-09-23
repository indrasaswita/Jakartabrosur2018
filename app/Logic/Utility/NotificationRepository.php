<?php

namespace App\Logic\Utility;

use App\Notification;
use DB;

class NotificationRepository
{
	public function getNotifCount($owner, $id){
		$item = $this->getNotifbyID($owner, $id);
		$count = 0;
		if(count($item)>0)
			$count = count($item);
		return $count;
	}

	public function getNotifbyID($owner, $id){
  	if($owner == ""){
  		$item = Notification::where('ownerID', NULL)
  				->orderBy(DB::raw('created_at, id'), 'DESC')
  				->get();
  	}else{
  		if($owner == 'EM'){

				$item2 = Notification::where('owner', $owner)
						->with('employee')
	  				->where('ownerID', NULL)
	  				->orderBy(DB::raw('created_at, id'), 'DESC')
	  				->get();

	  		$item = Notification::where('owner', $owner)
						->with('employee')
	  				->where('ownerID', $id)
	  				->orderBy(DB::raw('created_at, id'), 'DESC')
	  				->get();

	  		$item = $item2->merge($item);

			}else if($owner == 'CU'){

				$item2 = Notification::where('owner', $owner)
						->with('customer')
	  				->where('ownerID', NULL)
	  				->orderBy(DB::raw('created_at, id'), 'DESC')
	  				->get();

				$item = Notification::where('owner', $owner)
						->with('customer')
	  				->where('ownerID', $id)
	  				->orderBy(DB::raw('created_at, id'), 'DESC')
	  				->get();

	  		$item = $item2->merge($item);

			}else{
				return "ERROR INPUT";
			}

  	}
		return $item;
  }
}

