@extends('layouts.default')
@section('title', 'ORDER HERE!')
@section('content')

<div class="create-order" ng-controller="CreateOrderController">
	<div ng-init="setData({{json_encode($datas)}})">
	</div>
	<div class="selection-wrapper">
		<div class="list-navigator">
			<div class="list-wrapper">
				<button class="btn-navigator">
					Ukuran
				</button>
			</div>
			<div class="list-wrapper">
				<button class="btn-navigator">
					Material
				</button>
			</div>
			<div class="list-wrapper">
				<button class="btn-navigator">
					Finishing
				</button>
			</div>
			<div class="list-wrapper">
				<button class="btn-navigator">
					Pengiriman
				</button>
			</div>
			<div class="list-wrapper">
				<button class="btn-navigator">
					Pelengkap Data
				</button>
			</div>
		</div>

		<div class="create-list">
			<div class="list-calculation">
				<div class="title">
					Ukuran
				</div>
				<div class="input">
					<div class="btn-wrapper" ng-repeat="item in template.jobsubtypesize">
						<button class="btn-selection" ng-click="selectSize()">
							<b>[[item.size.width|number:0]]</b> x <b>[[item.size.length|number:0]]</b> cm
						</button>
					</div>
				</div>
				<div class="clear"></div>
				<div class="title">
					Material
				</div>
				<div class="input">
					<div class="btn-wrapper" ng-repeat="item in template.jobsubtypepapershop">
						<button class="btn-selection">
							<b>[[item.papershop.name]]</b> 
							<span ng-show="item.papershop.gramature!=0">	
								[[item.papershop.gramature|number:0]]g
							</span>
						</button>
					</div>
				</div>
				<div class="clear"></div>
				
				<div class="title">
					Quantity
				</div>
				<div class="input">
					<div class="btn-wrapper" ng-repeat="item in template.jobsubtypequantity">
						<button class="btn-selection">
							<b>[[item.quantity|number:0]]</b> [[template.satuan]]
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="cart-wrapper">
			<div class="order-cart">
				<div class="selection">
					<svg height="25" width="170">
					  <polygon points="70,-5 85,12 100,-5" class="poly" />
					</svg>
				</div>
				<div class="order-item">
					<div class="icon">
						<i class="fas fa-box-open fa-6x"></i>
					</div>
					<div class="btn-selection-group">
						<div class="btn-selection">
							<button class="select">
								<i class="fas fa-search"></i>
							</button>
						</div>
						<div class="btn-selection">
							<button class="template">
								<i class="fas fa-magic"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="order-convy">
					&nbsp;
				</div>
			</div>

			<div class="order-cart">
				<div class="order-item">
					<div class="icon">
						<i class="fas fa-box-open fa-6x"></i>
					</div>
					<div class="btn-selection-group">
						<div class="btn-selection">
							<button class="select">
								<i class="fas fa-search"></i>
							</button>
						</div>
						<div class="btn-selection dropdown">
							<button class="template" data-toggle="dropdown" menu-position="top">
								<i class="fas fa-magic"></i>
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" ng-repeat="item in jobsubtypes" href="#" ng-click="getTemplate(item.link)">[[item.name]]</a>
							</div>
						</div>
					</div>
				</div>
				<div class="order-convy">
					&nbsp;
				</div>
			</div>

			<div class="order-cart">
				<div class="order-item">
					<div class="icon">
						<i class="fas fa-box-open fa-6x"></i>
					</div>
					<div class="btn-selection-group">
						<div class="btn-selection">
							<button class="select">
								<i class="fas fa-search"></i>
							</button>
						</div>
						<div class="btn-selection">
							<button class="template">
								<i class="fas fa-magic"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="order-convy">
					&nbsp;
				</div>
			</div>
		</div>
	</div>
	<div class="summary-wrapper">
		<div class="print-detail">
			<div class="title">
				Ulasan 
			</div>
			<div class="list">
				<div class="list-title">
					Material
				</div>
				<div class="list-detail">
					Art Carton 190
				</div>
			</div>
			<div class="list">
				<div class="list-title">
					Ukuran
				</div>
				<div class="list-detail">
					21 x 29.7 cm
				</div>
			</div>
		</div>
		<div class="quotation">
			<div class="title">
				Penawaran
			</div>
			<div class="list">
				<div class="list-title">
					Total
				</div>
				<div class="list-detail">
					Rp 700.000
				</div>
			</div>
			<div class="list">
				<div class="list-title">
					Ongkos Kirim
				</div>
				<div class="list-detail">
					Rp 35.000
				</div>
			</div>
		</div>
	</div>
</div>
@stop