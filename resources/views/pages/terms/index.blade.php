@extends('layouts.default')
@section('title', 'Syarat & Ketentuan')
@section('content')

<div class="term-wrapper">

	<ul class="nav nav-tabs nav-tabs-purple">
		<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#condition">Syarat & Ketentuan</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#privacy">Kebijakan Privasi</a></li>
	</ul>

	<div class="tab-content">
    <div id="condition" class="tab-pane fade in active">
      @include('pages.terms.includes.condition')
    </div>
    <div id="privacy" class="tab-pane fade">
      @include('pages.terms.includes.privacy')
    </div>
    <div class="size-80p margin-20-0 text-xs-center"><u>Last updated: 27/06/2017</u></div>
  </div>

	

</div>

@stop