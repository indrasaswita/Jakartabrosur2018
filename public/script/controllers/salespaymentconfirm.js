module.exports = function(app){
	app.controller('PaymentConfirmController', ['$scope', '$http', 'BASE_URL', 'API_URL', 'AJAX_URL', '$window',
		function($scope, $http, BASE_URL, API_URL, AJAX_URL, $window){
			$scope.URL = 'http://localhost:8000/';
			$scope.selected = {};
			$scope.initData = function($input){
				$scope.salesheader = JSON.parse($input);

				$scope.salesheader.totalprice = 0;
				$.each($scope.salesheader.salesdetail, function($index, $item){
					$scope.salesheader.totalprice += (parseFloat($item.cartheader.printprice)+parseFloat($item.cartheader.deliveryprice)-parseFloat($item.cartheader.discount));
				});
				$scope.salesheader.totalpayment = 0;
				$.each($scope.salesheader.salespayment, function($index, $item){
					//brarti uda di verif
					$scope.salesheader.totalpayment += parseFloat($item.ammount);
				});
				//$scope.sisabayar = $scope.sales.totalprice - $scope.sales.payment;
				//$scope.sales['totalprice'] = parseFloat($scope.sales['totalprice']);

				$dt = new Date(Date.now());
				$dt.setHours(0);
				$dt.setMinutes(0);
				$dt.setSeconds(0);
				$scope.selected.paydate = $dt;
				$scope.selected.totaltransfer = 0;
				$scope.selected.compacc = 1;
				$scope.selected.confirmnote = '';
				$scope.selected.salesID = $scope.salesheader.id;

				//console.log($scope.salesheader);
			}
			$scope.zeroFill = function ( number, width )
			{
				if(number != null)
				{
					width -= number.toString().length;
					if ( width > 0 )
					{
					    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
					}
					return number + ""; // always return a string
				}
			}
			$scope.searchingkey = "";
			$scope.modal = {
				bankID : 5,
				accno: "",
				accname: "",
				acclocation: ""
			};

			$scope.selectBank = function($id){
				$scope.modal.bankID = $id;
			}
			$scope.searchOnBanks = function(){
				if ($scope.searchingkey == "")
					$scope.searchedbanks = $scope.banks;
				else
				{
					$scope.searchedbanks = [];
					for ($i = 0; $i < $scope.banks.length; $i++) {
						console.log($scope.banks[$i]['bankname']);
						if($scope.isContained($scope.banks[$i]['bankname'], $scope.searchingkey)
							|| $scope.isContained($scope.banks[$i]['alias'], $scope.searchingkey))
							$scope.searchedbanks.push($scope.banks[$i]);
					}
				}
			}
			$scope.isContained = function($string, $key){
				if ($string.toLowerCase().indexOf($key.toLowerCase()) != -1)
					return true;
				else
					return false;
			}

			$scope.fillBanks = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'banks'
					}
				).then(function(response) {
					$scope.banks = response.data;
					//$('#form-paperID').children().remove();
					$scope.searchOnBanks();
				});
			};
			$scope.fillBanks.call();
			$scope.fillCustAccs = function($customerID)
			{
				$http(
					{
						method : 'GET',
						url : AJAX_URL+'custaccs'
					}
				).then(function(response) {
					$scope.custaccs = response.data;
					//$('#form-custAcc').children().remove();
					if($scope.custaccs != null)
						$scope.selected.custacc = $scope.custaccs[0].id;
				});
			};
			$scope.fillCustAccs.call();

			//darigodhands
			$scope.fillCompanyBankAccs.call();

			$scope.storeAccs = function($customerID)
			{
				$http(
					{
						method : 'POST',
						url : AJAX_URL+'custaccs/store',
						data : $scope.modal
					}
				).then(function(response) {
					if(response.data == null){
						console.log('error');
					}else{
						$scope.custaccs = response.data;
						if($scope.custaccs != null)
							$scope.selected.custacc = $scope.custaccs[$scope.custaccs.length-1].id;
					}
				});
			};


			$scope.confirmPayment = function(){
				$http(
					{
						method 	: "POST",
						url			: API_URL+"payment/confirm",
						data		: $scope.selected
					}
				).then(function(response){
					$done = false;
					if(response.data != null)
					{
						if(response.data.constructor === String)
						{
							if(response.data == "success")
							{
								$done = true;
							}
						}
					}
					if($done == true)
						$window.location.href = BASE_URL+'sales/all';
				});
			}

			$scope.showNoRek = function(){
				$('#compaccnoModal').modal('show');
			}
		}
	]);
};