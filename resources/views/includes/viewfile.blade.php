

<table class="table table-sm">
	<thead class="text-center thead-inverse">
		<th>Gambar</th>
		<th>Detail</th>
		<th>Deskripsi</th>
		<th>Action</th>
	</thead>
	<tbody>
		<tr ng-repeat="item in cartfiles">
			<td><img ng-src="[[item.icon]]" class="img-circle" width="130px" height="130px"></td>
			<td>
				<table class="table table-clear">
					<tbody>
						<tr>
							<th>Nama File</th>
							<td>[[item.filename]]</td>
						</tr>
						<tr>
							<th>Revisi ke-</th>
							<td>[[item.revision]]</td>
						</tr>
						<tr>
							<th>Ukuran</th>
							<td>
								<table class="table table-clear">
									<tbody>
										<tr>
											<td>[[(item.size/1024)|number:0]] KB</td>
										</tr>
										<tr>
											<td>[[(item.size/1024/1024)|number:0]] MB</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td>[[item.detail]]</td>
			<td>
				<div class="btn-group-vertical display-block">
					<button class="btn btn-secondary">Revisi</button>
					<button class="btn btn-secondary">View</button>
					<button class="btn btn-secondary">Delete</button>
				</div>
			</td>
		</tr>
	</tbody>
</table>