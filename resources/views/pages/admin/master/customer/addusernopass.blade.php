@extends('layouts.container')
@section('title', 'Tambah Customer Baru')
@section('description', 'Tanpa Data Password.')
@section('robots', 'noindex,nofollow')
@section('content')

<div ng-controller="AddUserNoPassController">

@if(isset($customers))
	@if($customers != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $customers);
		?>
		<?php
			$temp2 = str_replace(array('\r', '\"', '\n', '\''), '?', $companies);
		?>

		@if(count($customers) != 0)
	<div ng-init="initData('{{$temp}}', '{{$temp2}}')"></div>
		@endif
	@endif
@endif


	<div class="addusernopass-wrapper">
		<div class="page-title">
			INPUT NEW CUSTOMER without password
		</div>

		<div class="addusernopass">
			<div class="title">
				Cari EMAIL Customer disini.
			</div>
			<input type="text" class="email ease" placeholder="Customer's e-mail" ng-model="activemail">
			<div class="btn-wrapper">
				<div class="email-error">
					[[emailerror]]
				</div>
				<button id="checkmail" class="btn btn-sm btn-outline-primary" ng-click="checkemail()">
					Check
				</button>
				<button id="resetmail" class="btn btn-sm btn-outline-primary" ng-click="resetmail()">
					Reset
				</button>
			</div>
		</div>
		<div class="result" ng-if="emailerror.length==0">
			<div class="foundmail form"
			ng-if="found!=null">
				<div class="title">
					Edit Akun yang sudah ada dibawah ini.
				</div>
				<div class="item">
					<i class="far fa-user-astronaut fa-fw"></i>
					Nama Pengguna
					<input type="text" placeholder="Nama Pengguna" ng-model="found.name">
				</div>
				<div class="item">
					<i class="fab fa-whatsapp fa-fw"></i>
					No. Whatsapp
					<input type="text" placeholder="No. yg ada WhatsApp-nya" ng-model="found.phone1">
				</div>
				<div class="item">
					<i class="far fa-phone fa-fw"></i>
					No. HP 2
					<input type="text" placeholder="No. HP Alternatif 2" ng-model="found.phone2">
				</div>
				<div class="item">
					<i class="far fa-phone fa-fw"></i>
					No. HP 3
					<input type="text" placeholder="No. HP Alternatif 3" ng-model="found.phone3">
				</div>
				<div class="item">
					<i class="fal fa-venus-mars fa-fw"></i>
					Gender
					<br>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':found.title=='Mr.'}" ng-click="found.title='Mr.'">
						<i class="fal fa-mars fa-fw"></i>
						Male
					</button>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':found.title=='Mrs.'}" ng-click="found.title='Mrs.'">
						<i class="fal fa-venus fa-fw"></i>
						Female
					</button>
				</div>
				<div class="item">
					<i class="fal fa-industry-alt fa-fw"></i>
					Tipe Akun
					<br>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':found.type=='personal'}" ng-click="found.type='personal';found.companyID=1">
						<i class="fal fa-user fa-fw"></i>
						personal
					</button>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':found.type=='employee'}" ng-click="found.type='employee'">
						<i class="fal fa-user-hard-hat fa-fw"></i>
						employee
					</button>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':found.type=='group'}" ng-click="found.type='group'">
						<i class="fal fa-user-friends fa-fw"></i>
						group
					</button>
					<br>
					<div class="" ng-if="found.type!='personal'">
						<i class="fal fa-industry-alt fa-fw"></i>
						Pilih Company
						<select ng-options="company.id as company.name for company in companies" ng-model="found.companyID"></select>
					</div>
				</div>
			
				<div class="text-xs-center padding-10-0">
					<button class="btn btn-sm btn-outline-primary" ng-click="updateusernopass()">
						SIMPAN PERUBAHAN DATA
					</button>
				</div>
			</div>
			<div class="addnew form"
			ng-if="found==null">
				<div class="title">
					Tambah Akun Baru dengan Email diatas.
				</div>
				<div class="item">
					<i class="far fa-user-astronaut fa-fw"></i>
					Nama Pengguna Baru
					<input type="text" placeholder="Nama Pengguna Baru" ng-model="newitem.name">
				</div>
				<div class="item">
					<i class="fab fa-whatsapp fa-fw"></i>
					No. Whatsapp
					<input type="text" placeholder="No. yg ada WhatsApp-nya" ng-model="newitem.phone1">
				</div>
				<div class="item">
					<i class="far fa-phone fa-fw"></i>
					No. HP 2
					<input type="text" placeholder="No. HP Alternatif 2" ng-model="newitem.phone2">
				</div>
				<div class="item">
					<i class="far fa-phone fa-fw"></i>
					No. HP 3
					<input type="text" placeholder="No. HP Alternatif 3" ng-model="newitem.phone3">
				</div>
				<div class="item">
					<i class="fal fa-venus-mars fa-fw"></i>
					Gender
					<br>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':newitem.title=='Mr.'}" ng-click="newitem.title='Mr.'">
						<i class="fal fa-mars fa-fw"></i>
						Male
					</button>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':newitem.title=='Mrs.'}" ng-click="newitem.title='Mrs.'">
						<i class="fal fa-venus fa-fw"></i>
						Female
					</button>
				</div>
				<div class="item">
					<i class="fal fa-industry-alt fa-fw"></i>
					Tipe Akun
					<br>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':newitem.type=='personal'}" ng-click="newitem.type='personal';newitem.companyID=1">
						<i class="fal fa-user fa-fw"></i>
						personal
					</button>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':newitem.type=='employee'}" ng-click="newitem.type='employee'">
						<i class="fal fa-user-hard-hat fa-fw"></i>
						employee
					</button>
					<button class="btn btn-sm ease" ng-class="{'btn-outline-primary':newitem.type=='group'}" ng-click="newitem.type='group'">
						<i class="fal fa-user-friends fa-fw"></i>
						group
					</button>
					<br>
					<div class="" ng-if="newitem.type!='personal'">
						<i class="fal fa-industry-alt fa-fw"></i>
						Pilih Company
						<select ng-options="company.id as company.name for company in companies" ng-model="newitem.companyID"></select>
					</div>
				</div>
				<div class="text-xs-center padding-10-0">
					<button class="btn btn-sm btn-outline-primary" ng-click="saveusernopass()">
						SIMPAN AKUN BARU
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
