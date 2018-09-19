<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobsubtype;

class JobsubtypeAPI extends Controller
{
    public function showbylink($pages){

    	$datas = Jobsubtype::where('link', '=', $pages)
					->with('jobsubtypepapershop')
					->with('jobsubtypesize')
					->with('jobsubtypequantity')
					->with('jobsubtypefinishingshop')
					->with('jobsubtypedetailshop')
					->with('printeroffset')
					->with('printerdigital')
					->with('jobsubtypetemplate')
					->first();
			return $datas;
    }
}
