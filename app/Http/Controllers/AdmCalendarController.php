<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offday;
use Carbon\Carbon;
use App\Logic\Utility\CalendarHelper;
use Illuminate\Support\Facades\Input;

class AdmCalendarController extends Controller
{
	public function index(){
		$offdays = Offday::orderBy('offday', 'asc')
					->get();


		$today = Carbon::now()->format('Y-m-d');

		$input = Input::all();

		if(array_key_exists('d', $input))
			$day = intval($input['d']);
		else
			$day = 0;

		if(array_key_exists('s', $input))
			$slice = intval($input['s']);
		else
			$slice = 14;

		$after = CalendarHelper::diffWithOffdays($day, $slice);


		return view('pages.admin.master.calendar.index', compact('offdays', 'today', 'after', 'day'));
	}
}
