@extends('layouts.directprint')
@section('title', 'Admin Print Invoice')
@section('content')

<div ng-controller="AllSmallInvoiceController" class="view-small-invoice">

	@if(isset($sales))
		@if($sales != null)
			<?php
				$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $sales);
			?>

	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif

	<div class="view-wrapper">

		<div class="invoice-small">
			<div class="title">
				NOTA 54
			</div>

			<button class="btn btn-sm btn-outline-purple" ng-click='printCard54()'>
				Cetak Nota 54
			</button>
		</div>
		<div class="invoice-small">
			<div class="title">
				INVOICE 80
			</div>

			<button class="btn btn-sm btn-outline-purple" ng-click='printCard80()'>
				Cetak Nota 80
			</button>
		</div>
		<div class="invoice-large">
			<div class="title">
				LARGE INVOICE
			</div>


			<a class="btn btn-sm btn-outline-purple" href="{{URL::asset('payment/invoice/pdf')}}/{{$sales['id']}}" target="_blank">
				Nota Besar di PDF
			</a>
		</div>
	</div>
</div>


@endsection