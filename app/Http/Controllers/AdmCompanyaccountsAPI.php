<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Curl\Klikbca;
use App\Companybankaccmutation;
use Carbon\Carbon;

class AdmCompanyaccountsAPI extends Controller
{
	public function read_bca($accid){
		$mulai = Carbon::now()->subDays(15);
		$mulai = $mulai->year.'-'.$mulai->month.'-'.$mulai->day;

		$datas = Companybankaccmutation::where('created_at', '>=', $mulai)
				->where('accountID', $accid)
				->orderBy('id', 'DESC')
				->limit(100)
				->get();

		return $datas;
	}

	public function mutasi_bca(Request $request, $accid){
		$ipaddress = $request->all();

		/*$klikbca = new klikbca_by_semprot();
		$klikbca->username = USERNAME;
		$klikbca->password = PASSWORD;*/
		$bca = new Klikbca($ipaddress);
		$res = $bca->login();
		 
		if ($res == false) {
			//echo $bca->last_html;
			return $this->read_bca($accid);
		}
		 
		$res = $bca->view_mutasi();
		 
		if ($res != false) {
			$data_grab = $bca->last_html;
		}

		//$data_grab = $this->testdata();

		$data_grab = str_replace('\r\n',"",$data_grab);
		$data_grab = trim(preg_replace('/\s+/', ' ', $data_grab));
		//BUAT TANGGAL
		$data_grab = str_replace(' width="30" bgcolor="#e0e0e0"><div align="left"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);
		$data_grab = str_replace(' width="30" bgcolor="#f0f0f0"><div align="left"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);

		//BUAT KETERANGAN
		$data_grab = str_replace(' width="130" bgcolor="#f0f0f0"><div align="left"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);
		$data_grab = str_replace(' width="130" bgcolor="#e0e0e0"><div align="left"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);


		//BUAT CODE TENGAH
		$data_grab = str_replace(' width="30" bgcolor="#e0e0e0"><div align="center"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);
		$data_grab = str_replace(' width="30" bgcolor="#f0f0f0"><div align="center"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);


		//BUAT MUTASI GANTI SALDO
		$data_grab = str_replace(' width="" bgcolor="#f0f0f0"><div align="right"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);
		$data_grab = str_replace(' width="30" bgcolor="#f0f0f0"><div align="center"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);

		//BUAT CR / DB
		$data_grab = str_replace(' width="" bgcolor="#e0e0e0"><div align="right"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);
		$data_grab = str_replace(' width="10" bgcolor="#f0f0f0"><div align="right"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);


		//BUAT TOTAL SALDO
		$data_grab = str_replace(' width="10" bgcolor="#f0f0f0"><div align="right"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);
		$data_grab = str_replace(' width="10" bgcolor="#e0e0e0"><div align="right"> <font face="verdana" size="1" color="#0000bb"',"",$data_grab);

		//BUAT ILANGIN KURUNG TUTUP

		$data_grab = str_replace('</font></div></td>',"",$data_grab);
		$data_grab = str_replace(' </tr> ',"",$data_grab);
		$data_grab = str_replace(' <br>',"; ",$data_grab);
		$data_grab = str_replace('<br>',"; ",$data_grab);
		$data_grab = str_replace('  '," ",$data_grab);
		$data_grab = str_replace('</table> </td></tr>',"",$data_grab);
		$data_grab = str_replace('/',"- ",$data_grab);


		$data = explode('<tr>', $data_grab);

		//dd($data);
		$result = array();
		$today = Carbon::now();
		for ($i=0; $i < count($data); $i++) { 
			if(is_numeric(substr($data[$i], -1))){
				$input = explode(' <td> ', $data[$i]);
				array_splice($input, 0, 1);
				array_splice($input, 2, 1);
				array_splice($input, 4, 1);
				$input[2] = intval(str_replace(',', '', str_replace('.00', '', $input[2])));
				if($input[0]!='PEND')
					$input[0] = '2018-'.substr($input[0], -2).'-'.substr($input[0], 0, 2);
				else{
					$input[0] = $today->year.'-'.$today->month.'-'.$today->day;
				}

				if($input[3] != "CR");
				if(is_string(strstr($input[1], "BUNGA")));
				else{
					$test = Companybankaccmutation::where('mutationDate', $input[0])
							->where('mutationNote', $input[1])
							->where('mutationAmmount', $input[2])
							->first();
					if($test == null){
						$obj = new Companybankaccmutation();
						$obj->accountID = $accid;
						$obj->mutationDate = $input[0];
						$obj->mutationNote = $input[1];
						$obj->mutationAmmount = $input[2];
						$obj->save();
					}
				}
			}
		}

		return $this->read_bca($accid);
	}
}