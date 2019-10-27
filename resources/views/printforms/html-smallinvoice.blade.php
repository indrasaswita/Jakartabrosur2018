@extends('layouts.directprint')

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
				SMALL INVOICE
			</div>

			<div id="invoice" class="invoice">
				<div>
					<?php
						$forpayment = sprintf("112%08d", $sales["id"]);
						$viewpayment = sprintf("114%08d", $sales["id"]);
					?>


					<div id="card">
						<img src='data:image/png;base64, {{DNS1D::getBarcodePNG($viewpayment, "EAN13")}}' alt='barcode' width="100%" ng-if="sales.totalpay>=sales.totalsales" />
						<img src='data:image/png;base64, {{DNS1D::getBarcodePNG($forpayment, "EAN13")}}' alt='barcode' width="100%" ng-if="sales.totalpay<sales.totalsales" />
					</div>
				</div>
			</div>

			<button class="btn btn-sm btn-outline-purple" ng-click='printCard()'>
				Cetak Nota Kecil
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