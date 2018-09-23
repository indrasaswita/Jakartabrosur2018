@extends('layouts.flyer')
@section('content')

	@if(isset($data))
		@if ($data != null)
			<div ng-init="initData('{{json_encode($data)}}')"></div>
		@endif
	@endif
	<div class="panel">
		<div class="panel-title">
			Deskripsi Pekerjaan
		</div>
		<div class="panel-item panel-item-orange">
			<div class="panel-item-header">
				 Judul Cetakan
			</div>
			<div class="panel-item-block">
				<div class="form-group" ng-class="{'has-danger':error.jobtitle != null}">
				    <input type="text" name="jobtitle" class="form-control" ng-class="{'form-control-danger':error.jobtitle != null}" ng-model="selected.jobtitle" value="{{Request::old('jobtitle')}}" />
				    
				    <div class="margin-0"><span class="text-muted size-14">[[(error.jobtitle[0])]]</span><span class="pull-xs-right">[[selected.jobtitle.length]] | max: 32</span></div>
			   	</div>
			</div>
		</div>
		<div class="panel-item panel-item-yellow">
			<div class="panel-item-header">
				 Catatan Tambahan
			</div>
			<div class="panel-item-block">
				<div class="form-group" ng-class="{'has-danger':error.customernote != null}">
			    	<textarea rows="5" name="customernote" class="form-control" ng-class="{'form-control-danger':error.customernote != null}" ng-model="selected.customernote" value="{{ (!empty(Input::old('customernote'))) ? Input::old('customernote') : 'hey' }}"></textarea>
			    	<div class="margin-0"><span class="text-muted size-14">[[(error.customernote[0])]]</span><span class="pull-xs-right">[[selected.customernote.length]] | max: 255</span></div>
			    </div>
			</div>

		    <div class="panel-item-footer">
		    	Catatan Tambahan : 
		    	<ol>
		    		<li>Warna dominan pada bagian apa untuk menjadi acuan warna?</li>
		    		<li>Pembagian jumlah lembar setiap bungkusan?</li>
		    		<li>Bila 'Upload' beberapa file, tolong berikan keterangan pada catatan.</li>
		    		<li>dan keterangan-keterangan lainnya.</li>
		    	</ol>
		    </div>
		</div>

		<!-- <button type="button" class="btn-purple btn-circle btn-sticky" id="btn-prev" ng-click="descriptionprev()" data-toggle="tooltip" data-title="Klik Untuk Kembali" data-placement="right">
			<span class="glyphicon glyphicon-chevron-left size-24"></span>
		</button>
		<button type="button" class="btn-purple btn-circle btn-sticky" id="btn-next" ng-click="descriptioncheckout()" data-toggle="tooltip" data-title="Klik Untuk Lanjut" data-placement="left">
			<span class="glyphicon glyphicon-chevron-right size-24"></span>
		</button> -->

	</div>
	@include('includes.sidebarflyersm')
	
@stop