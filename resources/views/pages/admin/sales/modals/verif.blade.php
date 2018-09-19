<div class="modal fade" id="verifModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <!-- <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Verifikasi Pembayaran</h4>
	      </div> -->
	      	<div class="modal-body">
	      		<form>
			      	<div class="input-group">
			      		<input class="form-control width-70" type="text" placeholder="Search here!" ng-model="searchingkey">
			      		<input class="form-control btn btn-purple width-30" type="submit" value="Search" ng-click="searchOnVerifs()"> 
			      	</div>
			      	<small class="form-text text-muted">Bisa cari dari: NAMA ACCOUNT, NOMOR ACCOUNT, JUMLAH PEMBAYARAN, & TOTAL BELANJA</small>
		      	</form>
		      	<div class="text-muted margin-40-0 text-xs-center" ng-hide="searchedpaiddatas.length > 0">
			        <span class="size-30">Belum ada yang konfirmasi pembayaran</span><br>
			        <span class="size-16">Silahkan tunggu hingga customer konfirmasi.<br></span>
			    </div>
		        <table class="table table-sm margin-10-0" ng-show="searchedpaiddatas.length > 0">
		        	<thead class="thead-inverse text-center">
		        		<tr>
		        			<td>Sales ID</td>
		        			<td>Rek. Customer</td>
		        			<td>=></td>
		        			<td>Rek. Company</td>
		        			<td>Total Transfer</td>
		        		</tr>
		        	</thead>
		        	<tbody>
		        		<tr dir-paginate="item in searchedpaiddatas | itemsPerPage:8" ng-class="{'bg-success':item.salesID==modalselected.salesID}" ng-click="selectVerif(item)">
		        			<td>#[[zeroFill(item.salesID, 5)]]</td>
		        			<td class="text-center">
		        				<table class="table table-clear">
		        					<tbody>
				        				<tr>
				        					<td>[[item.cubankname]]</td>
				        				</tr>
				        				<tr>
				        					<td>[[item.cuano]]-[[item.cuaname]]</td>
				        				</tr>
				        			</tbody>
			        			</table>
		        			</td>
		        			<td class="text-center">
		        				=>
		        			</td>
		        			<td class="text-center">
		        				<table class="table table-clear">
		        					<tbody>
				        				<tr>
				        					<td>[[item.cobankname]]</td>
				        				</tr>
				        				<tr>
				        					<td>[[item.coano]]-[[item.coaname]]</td>
				        				</tr>
				        			</tbody>
			        			</table>
		        			</td>
		        			<td class="width-15">Rp <span class="pull-xs-right">[[item.ammount|number:0]]</span></td>
		        		</tr>
		        	</tbody>
		        </table>
		        <table class="table table-sm">
		        	<thead>
		        	</thead>
		        	<tbody>
		        		<tr>
		        			<td class="text-center width-25">
		        				<div class="text-muted margin-40-0 text-xs-center" ng-hide="modalselected.salesID != null">
							        <span class="size-30">Belum Pilih</span><br>
							        <span class="size-16">Pilih transaksi diatas.<br></span>
							    </div>
			        			<table class="table table-clear" ng-show="modalselected.salesID != null">
				        			<tbody>
					        			<tr>
					        				<td>#[[zeroFill(modalselected.salesID, 5)]]</td>
					        			</tr>
					        			<tr>
					        				<td>Rp [[modalselected.totalprice|number:0]]</td>
					        			</tr>
					        			<tr>
					        				<td>[[modalselected.salesTime|date:'d/M/yy H:m:s']]</td>
					        			</tr>
				        			</tbody>
			        			</table>
		        			</td>
		        			<td>
		        				<label class="form-text text-muted">Total Yang Dibayar :</label>
		        				<div class="input-group border-collapse">
		        					<div class="input-group-addon">Rp</div>
		        					<!-- <input type="number" class="form-control text-center" ng-model="totaltransfer" placeholder="0,000,000,000"> -->
		        					<div class="form-control text-center">#[[zeroFill(modalselected.salesID, 5)]]</div>
		        					<span class="input-group-btn">
		        						<button class="btn btn-purple" ng-click="verify()">Verify!</button>
		        					</span>
		        				</div>
		        				<small class="form-text text-muted">Masukkan angka tanpa atribut atau spasi</small>
		        			</td>
		        		</tr>
		        	</tbody>
		        </table>
	      	</div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-purple" data-dismiss="modal">Close</button>
		    </div>
	    </div>
	  </div>
	</div>