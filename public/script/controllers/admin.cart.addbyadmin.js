module.exports = function(app){
	app.controller('AdminCartAddbyadminController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){

			$scope.setKertasPrinterIndex0 = function($index){
				if($scope.papers!=null)
					if($scope.papers.length>0)
						$scope.newcart.cartdetails[$index].paper = $scope.papers[0];
				if($scope.printers!=null)
					if($scope.printers.length>0)
						$scope.newcart.cartdetails[$index].printerID = $scope.printers[0].id;
			}

			$scope.addcartdetailsclicked = function(){
				$temp = {
					jobtype: "OF",
					paper: null,
					cartname: '',
					side1:4,
					side2:0,
					totalinprint:1,
					totalinprintx:1,
					totalinprinty:1,
					totalinprintrest:0,
					totalinplano:1,
					totalinplanox:1,
					totalinplanoy:1,
					totalinplanorest:0,
					inschiet:0,
					totaldruct:0,
					printlength:46,
					printwidth:30.5,
					imagelength:29.7,
					imagewidth:21,
					vendors:null,
					planos:null,
					paperprice:0,
					totalplano:0,
					planoqtyerror:true,
					printqtyerror:true,
					employeenote:'',
				};
				$scope.newcart.cartdetails.push($temp);
				$scope.setKertasPrinterIndex0(parseInt($scope.newcart.cartdetails.length)-1);
			}

			$scope.resetmodal = function(){
				var dt = new Date(Date.now());
				$scope.newcart = {
					customersales: null,
					quantity: 0,
					quantitytypename: '',
					buyprice: 0,
					printprice: 0,
					deliveryprice: 0,
					discount: 0,
					totalpackage: 1,
					totalweight: 0.1,
					processtype: 'std',
					deadline: dt,
					delivery: null,
					deliveryaddress: "",
					deliverytime: dt,
					jobtitle: "",
					itemdescription: "",
					reseller: "",
					resellerphone: "",
					reselleraddress: "",
					cartdetails: []
				};
				$scope.addcartdetailsclicked();

				if($scope.jobsubtypes!=null)
					if($scope.jobsubtypes.length>0){
						$scope.newcart.jobsubtype = $scope.jobsubtypes[0];
						$scope.newcart.quantitytypename = $scope.newcart.jobsubtype.satuan;
					}

				if($scope.deliveries != null)
					if($scope.deliveries.length>0)
						$scope.newcart.delivery = $scope.deliveries[0];

				$scope.setKertasPrinterIndex0(0);
				$scope.customerloading = false;
				$scope.jobtypesymbols = ["OF", "DG", "PL", "LL"];
			}
			$scope.resetmodal();

			$scope.getVendorPlanoByPaperID = function($index, $paperID){
				$http({
					method: "get",
					url: API_URL+"paper/"+$paperID+"/paperdetail/vendor-plano"
				}).then(
					function(response){
						$scope.newcart.cartdetails[$index].paperdetails = response.data;
						$scope.newcart.cartdetails[$index].planos = null;

						//DISTINCT buat cari plano yg unique saja
						$.each(response, function($i, $ii){
							$duplicated = false;
							$.each($scope.newcart.cartdetails[$index].planos, function($j, $jj){
								if($ii.planoID==$jj.id)
								{
									//KALO SUDAH ADA DI GANTI
									$duplicated = true;
								}
							});
							if($duplicated == false){
								//KALO NULL GA BISA ADD DATA
								if($scope.newcart.cartdetails[$index].planos==null)
									$scope.newcart.cartdetails[$index].planos = [];
								//KALO UDA BENTUK ARRAY baru di PUSH
								$scope.newcart.cartdetails[$index].planos.push($ii.plano);
							}
						});

						//KALO UDA ADA ARRAY DI UKURAN PLANO
						//DIPILIH INDEX 1
						if($scope.newcart.cartdetails[$index].planos!=null)
							if($scope.newcart.cartdetails[$index].planos.length>0) {
								$scope.newcart.cartdetails[$index].planosize = $scope.newcart.cartdetails[$index].planos[0];
								$scope.planosizechanged($index);
							}
					},function(error){
						$scope.newcart.cartdetails[$index].paperdetails = null;
						$scope.newcart.cartdetails[$index].planos = null;
						$scope.planosizechanged($index);
					}
				);
			}

			$scope.checktotaldruct = function($index){
				if(($scope.newcart.cartdetails[$index].totaldruct+$scope.newcart.cartdetails[$index].inschiet)
						*$scope.newcart.cartdetails[$index].totalinplano
						!=$scope.newcart.cartdetails[$index].totalplano)
				{
					//artinya tidak sesuai
					$scope.newcart.cartdetails[$index].planoqtyerror = true;
				}
				else
					$scope.newcart.cartdetails[$index].planoqtyerror = false;

				if($scope.newcart.cartdetails[$index].totalplano!=0)
					$scope.getHargaKertas($index);
			}

			$scope.calctotalplano = function($index){
				if($scope.newcart.cartdetails[$index].planoqtyerror)
				{
					$scope.newcart.cartdetails[$index].totalplano = ($scope.newcart.cartdetails[$index].totaldruct+$scope.newcart.cartdetails[$index].inschiet)*$scope.newcart.cartdetails[$index].totalinplano;

					$scope.checktotaldruct($index);
				}
			}

			$scope.planosizechanged = function($index){
				$scope.newcart.cartdetails[$index].vendors = null;
				if($scope.newcart.cartdetails[$index].paperdetails!=null)
				{
					$.each($scope.newcart.cartdetails[$index].paperdetails, function($i, $ii){
						if($ii.planoID == $scope.newcart.cartdetails[$index].planosize.id){
							//BRARTI UNTUK UKURAN YANG SAMA
							//BISA DAPET TOKO yg UNIQUE
							$duplicated = false;
							$.each($scope.newcart.cartdetails[$index].vendors, function($j, $jj){
								if($ii.vendorID == $jj.id)
								{
									//KALO SUDAH ADA DI GANTI duplicated = true
									$duplicated = true;
								}
							});
							if($duplicated == false){
								//KALO NULL GA BISA ADD DATA
								if($scope.newcart.cartdetails[$index].vendors==null)
									$scope.newcart.cartdetails[$index].vendors = [];
								//JIKA BELOM ADA & ukuran tepat
								//INPUT SETELAH JADI ARRAY
								$scope.newcart.cartdetails[$index].vendors.push($ii.vendor);
							}
						}
					});
					//KALO UDA ADA ARRAY DI UKURAN PLANO
					//DIPILIH INDEX 1
					if($scope.newcart.cartdetails[$index].vendors!=null)
						if($scope.newcart.cartdetails[$index].vendors.length>0)
							$scope.newcart.cartdetails[$index].vendor = $scope.newcart.cartdetails[$index].vendors[0];
				}
			}

			$scope.getHargaKertas = function($index){
				$scope.newcart.cartdetails[$index].paperprice = parseInt(parseFloat($scope.newcart.cartdetails[$index].totalplano)*$scope.getHargaKertasPerUnit($index));
			}

			$scope.getHargaKertasPerUnit = function($index){
				$selectedpaper = $scope.newcart.cartdetails[$index].paper;
				$selectedsize = $scope.newcart.cartdetails[$index].planosize;
				$selectedvendor = $scope.newcart.cartdetails[$index].vendor;

				$result = -1;
				
				if($selectedpaper!=null)
				{
					if($selectedsize!=null)
					{
						if($selectedvendor!=null)
						{
							$.each($scope.newcart.cartdetails[$index].paperdetails, function($i, $ii){
								if($ii.paperID == $selectedpaper.id &&
									$ii.vendorID == $selectedvendor.id &&
									$ii.planoID == $selectedsize.id)
								{
									$result = $ii.unitprice;
									return false;
								}
							});
						}	
					}	
				}
				return $result;
			}

			$scope.refreshcustomerdata = function(){
				$http({
					method: 'get',
					url: API_URL+'data/customers/name'
				}).then(function(response){
					$scope.customers = new Bloodhound({
					  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
					  queryTokenizer: Bloodhound.tokenizers.whitespace,
					  // `states` is an array of state names defined in "The Basics"
					  //local: $asdf
					  local: response
					});
					$scope.setcustomerautocomplete();
				})
			}
			$scope.refreshcustomerdata();

			$scope.printgramature = function($gram){
				if($gram>0)
					return " "+$gram+"gsm ";
				else
					return "";
			}

			$scope.setcustomerautocomplete = function(){
				$("#find-customer .typeahead").typeahead({
				  hint: false,
				  highlight: true,
				  minLength: 1
				}, 
				{
					name: 'customers',
					display: 'name',
					source: $scope.customers,
					templates: {
				    empty: [
				      '<div class="empty-message">',
				        'Tidak ketemu',
				      '</div>'
				    ].join('\n'),
				    suggestion: Handlebars.compile('<div><strong>{{name}}</strong> – {{address}}</div>')
				  }
				});
				$("#find-customer .typeahead").typeahead('open');

				$('#find-customer .typeahead').on('typeahead:selected', function(keydown, datum) {
				  //$scope. = $scope.clone(datum);
				  $scope.newcart.customerID = datum.id;
				  $scope.showcustomerdata(datum.id);
				});
			}

			$scope.jobsubtypechanged = function(){
				$scope.newcart.quantitytypename = $scope.newcart.jobsubtype.satuan;
			}

			$scope.showcustomerdata = function($customerID){
				//AUTO COMPLETE CUSTOMER
				if(!$scope.customerloading){
					$scope.customerloading = true;
					$http({
						method : "GET",
						url : API_URL+"customer/"+$customerID+"/sales"
					}).then(
						function(response){
							$scope.newcart.customersales = response.data;
							$scope.customerloading = false;
						},function(error){
							$scope.newcart.customersales = null;
							$scope.customerloading = false;
						}
					);
				}
			}
           
			$scope.submitaddbyadmin = function(){
				$http({
					method: 'POST',
					url: API_URL+'admin/cart/store',
					data: $scope.newcart
				}).then(function(response){
					console.log(response.data);
				})
			}

			$scope.customerpicked = function(){
				$scope.selectedcustomer = $("#find-customer .typeahead").typeahead('val');
			}
		}
	]);
};