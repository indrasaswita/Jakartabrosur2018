<div ng-init="setCustomerID('{{Session::get('userid')}}')"></div>

@include('modal', ['modalid'=>'createnewcompany', 'modaltitle'=>'Buat Perusahaan Baru', 'modalbody'=>'
	<div class="create-new-company">
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Hello</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>#1</td>
				</tr>
			</tbody>
		</table>
	</div>
', 'modalfooter'=>'
	<button class="btn btn-primary" ng-click="saveNewCompany()">Save</button>
'])

