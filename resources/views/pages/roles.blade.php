@extends('layouts.default')
@section('content')

<div class="container" ng-controller="RoleController">
	<br/><br /><br />
	<h1>Roles</h1>
	<table class="table table-striped table-sm table-center">
		<thead class="thead-inverse">
			<tr>
				<th scope="row">#</th>
				<th>Role Name</th>
				<th>Sale</th>
				<th>Purchase</th>
				<th>Delivery</th>
				<th>Work Order</th>
				<th>Customer</th>
				<th>Employee</th>
				<th>Report</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<?php $index = 0; ?>
		<tbody>
		@foreach($roles as $item)
			<tr>
				<?php $index++; ?>
				<td scope="row">{{$index}}</td>
				<td>
					{{$item->name}}
				</td>
				<td>
					<span class="glyphicon <?php if ($item->sale==1) {echo 'glyphicon-ok';} else {echo 'glyphicon-remove';} ?>"> </span>
				</td>
				<td>
					<span class="glyphicon <?php if ($item->purchase==1) {echo 'glyphicon-ok';} else {echo 'glyphicon-remove';} ?>"> </span>
				</td>
				<td>
					<span class="glyphicon <?php if ($item->delivery==1) {echo 'glyphicon-ok';} else {echo 'glyphicon-remove';} ?>"> </span>
				</td>
				<td>
					<span class="glyphicon <?php if ($item->workorder==1) {echo 'glyphicon-ok';} else {echo 'glyphicon-remove';} ?>"> </span>
				</td>
				<td>
					<span class="glyphicon <?php if ($item->customer==1) {echo 'glyphicon-ok';} else {echo 'glyphicon-remove';} ?>"> </span>
				</td>
				<td>
					<span class="glyphicon <?php if ($item->employee==1) {echo 'glyphicon-ok';} else {echo 'glyphicon-remove';} ?>"> </span>
				</td>
				<td>
					<span class="glyphicon <?php if ($item->report==1) {echo 'glyphicon-ok';} else {echo 'glyphicon-remove';} ?>"> </span>
				</td>
				<td>
					<button class="btn btn-sm btn-success" ng-click="setFormValue({{$item}})"> Update </button>
				</td>
				<td>
					{!! Form::open(['method' => 'DELETE', 'url' => 'roles/'.$item->id, 'class'=>'form-inline']) !!}
			            {!! Form::hidden('id', $item->id) !!}
			            {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
		          	{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">

			@if ( $errors->any() ) 
				<ul class="alert alert-danger">
					@foreach ( $errors->all() as $item )
						<li>{{ $item }}</li>
					@endforeach
				</ul>
			@endif

			<div class="form-wrapper">
			{!! Form::open(['url' => 'roles', 'id' => 'form-open']) !!}
				<h3>Add Role</h3>
				<!-- <input class="form-control" type="text" ng-model="selected" placeholder="Role Name"> -->
				{!! Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Role Name', 'ng-model'=>'selected']) !!}
				<input name="_method" type="hidden" value="POST" id="form-method">
				<input type="hidden" value="0" id="form-id" name="id">
				<div class="sub-form">
			  	<table class="table table-sm table-striped">
			  		<tr ng-repeat="item in rolelists">
		  				<td>
					    	<label class="radio-title">[[item.label]]</label>
					  	</td>
			  			<td class="center">
				  			<!-- <div class="input-group radio" > -->
							    <label class="custom-control custom-radio">
							      <!-- <input ng-model="item.selected" id="title-male" name="title-[[item.value]]" type="radio" class="custom-control-input" value="1"> -->
							      {!! Form::radio('[[item.value]]', '1', false, ['class'=>'custom-control-input', 'ng-model'=>'item.selected']) !!}
							      <span class="custom-control-indicator"></span>
							      <span class="custom-control-description">[[item.bool1]]</span>
							    </label>
							  <!-- </div>
							  <div class="input-group radio" > -->
							    <label class="custom-control custom-radio">
							      <!-- <input ng-model="item.selected" id="title-female" name="title-[[item.value]]" type="radio" class="custom-control-input" value="0"> -->
							      {!! Form::radio('[[item.value]]', '0', false, ['class'=>'custom-control-input', 'ng-model'=>'item.selected']) !!}
							      <span class="custom-control-indicator"></span>
							      <span class="custom-control-description">[[item.bool2]]</span>
							    </label>
							  <!-- </div> -->
						  </td>
				    </tr>
				  </table>
				  <div class="btn-group pull-lg-right" role="group">
				  	{!! Form::submit('Update', ['class'=>'btn btn-secondary', 'disabled', 'id'=>'btn-update']) !!}
				  	<a class="btn btn-secondary" ng-click="cancelUpdate()" id="btn-cancel" hidden> Cancel </a>
				  	{!! Form::submit('Add New', ['class'=>'btn btn-primary', 'id'=>'btn-add']) !!}
					  <!-- <button class="btn btn-secondary"> Update </button>
					  <button class="btn btn-primary"> Add New </button> -->
				  </div>
			  </div>
			</div>
			{!! Form::close() !!}
		</div>
		<div class="col-lg-3"></div>
	</div>
</div>
@stop