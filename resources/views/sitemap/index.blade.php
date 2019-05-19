<?php 

echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	@foreach($sitemaps as $sitemap)

		<?php
		if($sitemap->chfreq == 0)
			$sitemap->chfreq = 'always';
		else if($sitemap->chfreq == 1)
			$sitemap->chfreq = 'hourly';
		else if($sitemap->chfreq == 2)
			$sitemap->chfreq = 'daily';
		else if($sitemap->chfreq == 3)
			$sitemap->chfreq = 'weekly';
		else if($sitemap->chfreq == 4)
			$sitemap->chfreq = 'monthly';
		else if($sitemap->chfreq == 5)
			$sitemap->chfreq = 'yearly';
		else if($sitemap->chfreq == 6)
			$sitemap->chfreq = 'never';
		else
			$sitemap->chfreq = '';


		?>
		<url>
			<loc>http://www.jakartabrosur.com/{{$sitemap->loc}}</loc>
			<lastmod>{{date('c', strtotime($sitemap->created_at))}}</lastmod>
		@if($sitemap->chfreq!='')
			<changefreq>{{$sitemap->chfreq}}</changefreq>
		@endif
			<priority>{{intval($sitemap->prio)/10}}</priority>
		</url>
	@endforeach
</urlset>