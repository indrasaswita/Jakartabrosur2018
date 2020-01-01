<?php

namespace App\Logic\Utility;
use Carbon\Carbon;
use App\Offday;

class CalendarHelper
{

	public static function diffWithOffdays($day, $slice)
	{
		$today = Carbon::now();


		if($day == null){

			$after = $today->format('Y-m-d');
		}else{
			$offdays = Offday::orderBy('offday', 'asc')
					->get();

			$nw = clone($today);
			//echo "now: ".$nw."<br>";

			$hr = intval($nw->format('H'));
			$yr = intval($nw->format('Y'));
			$mn = intval($nw->format('m'));
			$dt = intval($nw->format('d'));

			$af = clone($nw);
			$todayminggu = false;
			if($af->dayOfWeek==0){
				//HARI INI HARI MINGGU BRO
				$todayminggu = true;
				$af->addDay();
			}
			$afterslice = false;
			if($hr>=$slice){
				//KALO LEBIH DARI JAM 13.59
				//DIHITUNG BESOK
				$afterslice = true;

				if($todayminggu)
					$af->subDay();
				$af->addDays($day+1);
			}else{
				$af->addDays($day);
			}
			$af->setTime(9,0,2);

			$count = 0;
			$offday_temp = [];
			$nw_temp = clone($nw);
			$nw_temp2 = clone($nw);
			$nw_temp->setTime(9,0,0);
			$nw_temp2->setTime(9,0,1);

			//check ada minggu diantara nwtemp dan af ga
			for($i = 0; $i < $af->diffInDays($nw_temp2); $i++){
				$nw_temp2->addDay();
				if($nw_temp2->dayOfWeek==0){
					$af->addDay();
					//echo ("++ minggu<br>");
				}
			}

			foreach ($offdays as $i => $offday) {
				$temp = Carbon::createFromFormat('Y-m-d', $offday['offday']);
				$temp->setTime(9,0,1);
				if($temp->between($nw_temp, $af)){
					//kalo kecari ga usa di search lagi
					//echo ("--> ".$offday['offday']."<br>");
					if(!$afterslice && $nw_temp == $temp){
						//kalo hari ini libur, di cek, brarti tetap di tambahin harinya, soalnya ga ada masuk sebelom jam 2
						$af->addDay();
						$afterslice = true;
						//echo ("hari ini libur bro<br>");
					}
					$count++;
					//echo ("kena libur : ".$offday['offday']." - ++ coutn : ".$count."<br>");
				}else{
					//jadi kalo ga kecari, sisanya dimasukin ke offday_temp
					//nanti buat di cari di tempat selanjutnya setelah di addday satupersatu
					//echo ("sisa libur : ".$offday['offday']." - coutn : ".$count."<br>");
					array_push($offday_temp, $temp);
				}
			}

			//dd($count);
			//$count -> brapa banyak hari yang kena libur diantara $nw dan $af
			//echo "after: ".$af."<br>";
			//echo "COUNT - : ".$count."<br>";

			$a = 0;
			if($af->dayOfWeek==0){
				//kalo jatoh hari minggu langsung di add countnya
				$count++;
			}

			if($count == 0){
				$after = $af->format('Y-m-d');
			}else{
				while($count>0&&$a<30){
					$bf = clone($af);
					$bf->setTime(9,0,0);
					//$bf->subSecond();
					$af->addDay();
					$af->setTime(9,0,2);

					//echo "count ".$count."<br>";
	
					if($bf->dayOfWeek==0){
						//echo "MINGGU: ".$bf.".<br>";
					}else{
						//echo ("sisa hari libur: ".count($offday_temp)."<br>");
						if(count($offday_temp)==0){
							//offdayTemp abis, uda ga ada hari libur
							//echo "-> 0: ".$bf."<br>";
							$count--;
						}else{
							$adalibur = false;
							for ($i=count($offday_temp)-1; $i >= 0; $i--) { 
								if(($offday_temp[$i])->between($bf, $af)){
									//echo "cek : ".($offday_temp[$i])." ->libur: ".$bf." ~ ".$af."<br>";
									$adalibur = true;
									//unset($offday_temp[$i]);
								}
							}

							if(!$adalibur){
								$count--;
								//echo "masuk : ".$bf." ~ ".$af."<br>";
							}
						}
					}
					$a++;
				}

				$after = $bf->format('Y-m-d');
			}
		}
		


		return $after;
	}

}