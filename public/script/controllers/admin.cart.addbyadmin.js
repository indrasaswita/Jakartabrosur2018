module.exports = function(app){
	app.controller('AdminCartAddbyadminController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){

			$scope.getVendorPlanoByPaperID = function($i, $paper){
				$temp = [];
				$.each($paper.paperdetail, function($j, $jj){
					$found = false;
					$.each($temp, function($k, $kk){
						if($kk.id == $jj.plano.id){
							$found = true;
							return false;
						}
					});
					if(!$found)
						$temp.push($jj.plano);
				});
				$scope.newcart.cartdetails[$i].planos = $temp;
				if($temp.length>0){
					$scope.newcart.cartdetails[$i].planosize = $temp[0];
					$scope.planosizechanged($i, $paper);
				}
			}

			$scope.vendorchanged = function($index){
				$scope.newcart.cartdetails[$index].paperpriceunit = $scope.getHargaKertasPerUnit($index);
			}
			
			$scope.setKertasPrinterIndex0 = function($index){
				if($scope.papers!=null)
					if($scope.papers.length>0){
						$scope.newcart.cartdetails[$index].paper = $scope.papers[0];

						$scope.getVendorPlanoByPaperID($index, $scope.papers[0]);
					}
				if($scope.printers!=null)
					if($scope.printers.length>0)
						$scope.newcart.cartdetails[$index].printerID = $scope.printers[0].id;
			}

			$scope.planosizechanged = function($i, $paper){
				$temp = [];
				$.each($paper.paperdetail, function($j, $jj){
					if($jj.planoID == $scope.newcart.cartdetails[$i].planosize.id){
						$found = false;
						$.each($temp, function($k, $kk){
							if($kk.id == $jj.vendor.id){
								$found = true;
								return false;
							}
						});
						if(!$found)
							$temp.push($jj.vendor);
					}
				});
				$scope.newcart.cartdetails[$i].vendors = $temp;
				if($temp.length>0){
					$scope.newcart.cartdetails[$i].vendor = $temp[0];
					$scope.vendorchanged($i);
				}
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

			$scope.getHargaKertasPerUnit = function($index){
				$selectedpaper = $scope.newcart.cartdetails[$index].paper;
				$selectedsize = $scope.newcart.cartdetails[$index].planosize;
				$selectedvendor = $scope.newcart.cartdetails[$index].vendor;

				$result = -1;
				
				if($scope.newcart.cartdetails[$index].paper!=null &&
						$scope.newcart.cartdetails[$index].vendor!=null && 
						$scope.newcart.cartdetails[$index].planosize!=null)
					{
					var selectedvendorID = $scope.newcart.cartdetails[$index].vendor.id;
					var selectedplanoID = $scope.newcart.cartdetails[$index].planosize.id;
					$.each($scope.newcart.cartdetails[$index].paper.paperdetail, function($i, $ii){
						console.log($ii.vendorID+" == "+selectedvendorID+"    -> "+ $ii.planoID+" == "+selectedplanoID);
						if($ii.vendorID == selectedvendorID &&
							$ii.planoID == selectedplanoID)
						{
							console.log($ii.unitprice);   
							$result = $ii.unitprice;
							return false;
						}
					});
				}else{
					console.log("Muka bebek");
				}
				return $result;
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
					cartdetails: [],
					hidedeliveryprice: false,
					hidediscount: false,
					hidetotalweight: false,
					hidedeadline: false,
					hidedelivery: false,
					hidedeliveryaddress: false,
					hidedeliverytime: false
				};
				$scope.addcartdetailsclicked();

				if($scope.jobsubtypes!=null){
					if($scope.jobsubtypes.length>0){
						$scope.newcart.jobsubtype = $scope.jobsubtypes[0];
						$scope.newcart.quantitytypename = $scope.newcart.jobsubtype.satuan;
					}
				}else{
					$('#addbyadminModal').modal('hide');
				}

				if($scope.deliveries != null)
					if($scope.deliveries.length>0)
						$scope.newcart.delivery = $scope.deliveries[0];

				$scope.setKertasPrinterIndex0(0);
				$scope.customerloading = false;
				$scope.jobtypesymbols = ["OF", "DG", "PL", "LL"];
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

			$scope.getHargaKertas = function($index){
				if($scope.newcart.cartdetails[$index].paperpriceunit != 0){
					$scope.newcart.cartdetails[$index].paperprice = parseInt(parseFloat($scope.newcart.cartdetails[$index].totalplano)*$scope.newcart.cartdetails[$index].paperpriceunit);
				}
			}

			$scope.refreshcustomerdata = function(){
				$http({
					method: 'get',
					url: AJAX_URL+'data/customers/name'
				}).then(function(response){
					$scope.customers = new Bloodhound({
					  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
					  queryTokenizer: Bloodhound.tokenizers.whitespace,
					  // `states` is an array of state names defined in "The Basics"
					  //local: $asdf
					  local: response.data
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
				    suggestion: Handlebars.compile('<div class="line-1">'
				    	+'{{name}} &nbsp;<small>{{phone1}}<br>{{email}} &nbsp; {{phone2}}</small>'
				    	+'</div>')
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
				console.log($scope.newcart.jobsubtype);

				if($scope.newcart.jobsubtype.jobtype.id == 8){
					//SETTING

					$scope.newcart.quantitytypename = "jam";
					$scope.newcart.quantitytypename = "jam";
					$scope.newcart.quantitytypename = "jam";
					$scope.newcart.hidereseller = true;
					$scope.newcart.reseller = "";
					$scope.newcart.hidedeliveryprice = true;
					$scope.newcart.hidedeliveryprice = true;
					$scope.newcart.deliveryprice = 0;
					$scope.newcart.hidedeliveryprice = true;
					$scope.newcart.discount = 0;
					$scope.newcart.hidediscount = true;
					$scope.newcart.totalweight = 0;
					$scope.newcart.hidetotalweight = true;
					$scope.newcart.processtype = 0;
					$scope.newcart.deadline = 0;
					$scope.newcart.hidedeadline = true;
					$scope.newcart.delivery = $scope.deliveries[0];
					$scope.newcart.hidedelivery = true;
					$scope.newcart.deliveryaddress = "";
					$scope.newcart.hidedeliveryaddress = true;
					$scope.newcart.hidedeliverytime = true;

					$.each($scope.newcart.cartdetails, function($i, $ii){
						$ii.hidepaper = true;
						$ii.paper = null;
						$ii.planosize = null;
						$ii.vendor = null;
						$ii.hideprinter = true;
						$ii.hidedruct = true;
						$ii.side1 = 1;
						$ii.side2 = 0;
						$ii.hidesdp = true;
						$ii.jobtype = "DG";
					});
				}else{
					$scope.newcart.hidedeliveryprice = false;
					$scope.newcart.hidediscount = false;
					$scope.newcart.hidetotalweight = false;
					$scope.newcart.hidedeadline = false;
					$scope.newcart.hidedelivery = false;
					$scope.newcart.hidedeliveryaddress = false;
					$scope.newcart.hidedeliverytime = false;

					$.each($scope.newcart.cartdetails, function($i, $ii){
						$ii.hidepaper = false;
						$ii.paper = papers[0];
						$scope.getVendorPlanoByPaperID($i, $ii.paper);
						$ii.planosize = detail.planos[0];
						$ii.vendor = detail.vendors[0];
						$ii.hideprinter = false;
						$ii.hidedruct = false;
						$ii.hidesdp = false;
						$ii.jobtype = "OF";
					});
				}
			}

			$scope.showcustomerdata = function($customerID){
				//AUTO COMPLETE CUSTOMER
				if(!$scope.customerloading){
					$scope.customerloading = true;
					$http({
						method : "GET",
						url : AJAX_URL+"customer/"+$customerID+"/sales"
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



			$scope.resetmodal();
		}
	]);
};