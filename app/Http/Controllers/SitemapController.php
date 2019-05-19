<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sitemap;

class SitemapController extends Controller
{
	public function index(){
		$sitemaps = Sitemap::all();

		return response()->view('sitemap.index', compact('sitemaps'))->header('Content-Type', 'text/xml');
	}
}
