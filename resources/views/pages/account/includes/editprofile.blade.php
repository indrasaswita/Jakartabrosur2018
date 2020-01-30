<div class="order-panel tab-pane  active" id="profile">
	<div class="editprofiledata">
		<div class="data-row">
			<div class="data-title">Panggilan</div>
			<div class="data-input check">
				<div class="data-input-check">
					<input type="radio" class="" value="Mr." name="gender" ng-model="customer.title"> 
					<div class="label">Mr.</div>
				</div>
				<div class="data-input-check">
					<input type="radio" class="" value="Ms." name="gender" ng-model="customer.title" ng-change="validate()"> 
					<div class="label">Ms.</div>
				</div>
				<div class="data-input-check">
					<input type="radio" class="" value="Mrs." name="gender" ng-model="customer.title" ng-change="validate()"> 
					<div class="label">Mrs.</div>
				</div>
			</div>
			<div class="data-error">
				[[error.gender]]
			</div>
		</div>
		<div class="data-row">
			<div class="data-title">Nama Lengkap</div>
			<div class="data-input">
				<input type="text" ng-model="customer.name" placeholder="Full Name" ng-change="validate()">
			</div>
			<div class="data-error">
				[[error.name]]
			</div>
		</div>
		<div class="data-row">
			<div class="data-title">E-mail</div>
			<div class="data-input">
				<input type="email" ng-model="customer.email" placeholder="E-mail">
			</div>
			<div class="data-error">
				[[error.email]]
			</div>
		</div>
		<div class="data-row">
			<div class="data-title">Telepon 1</div>
			<div class="data-input">
				<input type="text" ng-model="customer.phone1" placeholder="Phone 1" ng-change="validate()">
			</div>
			<div class="data-error">
				[[error.phone1]]
			</div>
		</div>
		<div class="data-row">
			<div class="data-title">Telepon 2</div>
			<div class="data-input">
				<input type="text" ng-model="customer.phone2" placeholder="Phone 2" ng-change="validate()">
			</div>
			<div class="data-error">
				[[error.phone2]]
			</div>
		</div>
		<div class="data-row">
			<div class="data-title">Telepon 3</div>
			<div class="data-input">
				<input type="text" ng-model="customer.phone3" placeholder="Phone 3" ng-change="validate()">
			</div>
			<div class="data-error">
				[[error.phone3]]
			</div>
		</div>
		<div class="row margin-10-0">
			<div class="col-xs-12 text-xs-center">
				<input type='checkbox' class="form-check-input" ng-change="setNews(customerData.newsvalue)" ng-model="customer.news">
				<span>Dengan ini Anda ingin menerima berita baru lewat email. <div class="badge badge-danger text-regular">not yet</div></span>
			</div>
		</div>
		<div class="row margin-0">
			<div class="col-xs-12 text-xs-center">
				<button class="btn btn-purple" ng-click="changeProfile()">Change!</button>
			</div>
		</div>
	</div>
</div>