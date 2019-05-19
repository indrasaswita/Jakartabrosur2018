module.exports = function(app){
	app.controller('TrackingController', ['$scope', '$http', 'API_URL', 
		function($scope, $http, API_URL){
			
			$scope.initHeader = function($input){
				$scope.headers = JSON.parse($input);
				console.log($scope.headers);

				for ($i = 0; $i < $scope.headers.length; $i++) {
					$scope.headers[$i].lastUpdate = $scope.makeDateTime($scope.headers[$i].lastUpdate+"");
					$scope.headers[$i].salesTime = $scope.makeDateTime($scope.headers[$i].salesTime+"");
					$scope.headers[$i].showdetail = false;
					$scope.headers[$i].showdelivery = false;
					$scope.headers[$i].showpayment = false;
				}
			};

			$scope.showdetail = function($item){
				$show = true;
				if($item.showdetail == true)
					$show = false;

				$.each($scope.headers, function($index, $item2){
					$item2.showdetail = false;
					$item2.showpayment = false;
					$item2.showdelivery = false;
				});

				if($show)
					$item.showdetail = true;
			}

			$scope.showpayment = function($item){
				$show = true;
				if($item.showpayment == true)
					$show = false;

				$.each($scope.headers, function($index, $item2){
					$item2.showdetail = false;
					$item2.showpayment = false;
					$item2.showdelivery = false;
				});

				if($show)
					$item.showpayment = true;
			}

			$scope.showdelivery = function($item){
				$show = true;
				if($item.showdelivery == true)
					$show = false;

				$.each($scope.headers, function($index, $item2){
					$item2.showdetail = false;
					$item2.showpayment = false;
					$item2.showdelivery = false;
				});

				if($show)
					$item.showdelivery = true;
			}

			$scope.selectVerif = function($item){
				$scope.modalselected = $item;
				$scope.modalselected.salesTime = $scope.makeDateTime($scope.modalselected.salesTime);
			};
			$scope.searchOnVerifs = function(){
				//console.log($scope.paiddatas);
				if ($scope.searchingkey == "")
					$scope.searchedpaiddatas = $scope.paiddatas;
				else
				{
					$scope.searchedpaiddatas = [];
					for ($i = 0; $i < $scope.paiddatas.length; $i++) {
						if($scope.isContained($scope.paiddatas[$i]['accname'], $scope.searchingkey)
							|| $scope.isContained($scope.paiddatas[$i]['accno']+"", $scope.searchingkey)
							|| $scope.isContained($scope.paiddatas[$i]['bankname']+"", $scope.searchingkey)
							|| $scope.isContained($scope.paiddatas[$i]['ammount']+"", $scope.searchingkey))
							$scope.searchedpaiddatas.push($scope.paiddatas[$i]);
					}
				}
			};
			$scope.isContained = function($string, $key){
				if ($string.toLowerCase().indexOf($key.toLowerCase()) != -1)
					return true;
				else
					return false;
			};

			$scope.setHeaderFromValue = function($salesheader){
				$scope.headerselected = $salesheader;
				//console.log($scope.headerselected);
				/*$temp = $salesheader.tempo.split(' ')[0];
				$temp = $temp.split('-');
				$scope.headerselected.tempo = new Date($temp[0], $temp[1]-1, $temp[2]);*/
				$scope.getDetailData($salesheader.salesID);

			};
			$scope.setDetailFromValue = function($salesdetail){
				$scope.detailselected = $salesdetail;
				$scope.getCartData($salesdetail.cartdetailID);
			}
			$scope.totalDetail = 0;
			$scope.getDetailData = function($id){
				$http(
					{
						method : 'GET',
						url : API_URL + 'salesdetails/'+$id+'/header'
					}
				).then(function(response) {
					$scope.salesdetails = response.data;
					$scope.totalDetail = 0;
					for($i = 0; $i < response.length; $i++){
						$scope.totalDetail = $scope.totalDetail + parseInt(response[$i].totalprice);
					}
				});
			}
			$scope.getCartData = function($id){
				$http(
					{
						method : 'GET',
						url : API_URL + 'cartdetails/'+$id+'/header'
					}
				).then(function(response) {
					$scope.cartdetails = response.data;
				});
			}
			$scope.cancelUpdate = function(){
				$('#btn-cancel').attr('hidden', 'hidden');
				$('#btn-add').removeAttr('hidden');
				$('#btn-update').removeClass('btn-primary').addClass('btn-second').attr('disabled', 'disabled');
				$('#form-open').attr('action', $scope.URL+'salesheader');
				$('#form-method').val('POST');
			}
			
			$scope.fillPapers.call();

			$scope.getVerifData = function()
			{
				console.log('verif');
				$http(
					{
						method : 'GET',
						url : API_URL + 'verif'
					}
				).then(function(response) {
					console.log(response);
					$scope.paiddatas = response.data;
					$scope.searchOnVerifs();
					//$('#form-paperID').children().remove();
				});
			};
			//$scope.getVerifData.call();

			$scope.verify = function()
			{
				$http(
					{
						method 	: 'POST',
						url 	: API_URL + 'verif/store',
						data 	: {
							'id' 		: $scope.modalselected.salesID
						}
					}
				).then(function(response) {
					console.log(response);
				});
			}

			
			$scope.searchingkey = "";
			$scope.modal = {
				bankID : 5,
				accno: "",
				accname: "",
				acclocation: ""
			};
		}
	]);
};