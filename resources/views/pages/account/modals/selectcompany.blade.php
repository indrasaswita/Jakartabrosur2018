<div ng-init="setCustomerID('{{Session::get('userid')}}')"></div>

@include('modal', ['modalid'=>'selectcompany', 'modaltitle'=>'Pilih Perusahaan Anda', 'modalbody'=>'
	<div class="select-company" ng-if="!loadingcompanies">
		<table class="table table-sm">
			<thead>
				<td><i class="fal fa-hashtag"></td>
				<td><i class="fal fa-store"></i> Name</td>
				<td><i class="fal fa-location-circle"></i> Location</td>
				<td><i class="fal fa-phone fa-flip-horizontal"></i> Phone</td>
				<td>Type</td>
			</thead>
			<tbody>
				<tr ng-repeat="item in companies" ng-click="saveSelectCompany(item)">
					<td>[[item.id]]</td>
					<td>[[item.name]]</td>
					<td>
						<ul>
							<li ng-repeat="item2 in item.companyaddress">[[item2.address.address]] ([[item2.address.name]])</li>
						</ul>
					</td>
					<td>
						<span ng-if="item.phone1!=null">
							[[item.phone1]]<br>
						</span>
						<span ng-if="item.phone2!=null">
							[[item.phone2]]<br>
						</span>
						<span ng-if="item.phone3!=null">
							[[item.phone3]]<br>
						</span>
					</td>
					<td>[[item.type]]</td>
				</tr>
			</tbody>
		</table>
	</div>
', 'modalfooter'=>'
	<button class="btn btn-primary" ng-click="saveSelectCompany()">Save</button>
'])

