@extends('layouts.default')
@section('content')

<div class="container" ng-controller="CreateHeaderController" ng-init="">
	<br><br><br><br>
	@if(isset($id))
	<div ng-init="initSelectedID({{$id}})"></div>
	@endif
	<div class="row">
		<div class="col-lg-8">
			<table class='table table-sm'>
				<thead class="text-center thead-inverse">
					
				</thead>
				<tbody>
					<tr>
						<td><input type="text" class="form-control" ng-model="" placeholder=""></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop