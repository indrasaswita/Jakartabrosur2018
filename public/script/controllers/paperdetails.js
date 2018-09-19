module.exports = function(app){
	app.controller('PaperDetailController', ['$scope', '$http', 'API_URL', 
		function($scope, $http, API_URL){
			$scope.searchingkey = "";
			$scope.selected={
				'papername' : '', 
				'width' : 0, 
				'length' : 0,
				'vendorname' : '',
				'phone1' : '',
				'phone2' : '',
				'phone3' : '',
				'totalprice' : 0,
				'totaltypename' : 'rim',
				'unitprice' : 0,
				'unittypename' : 'kg',
				'vendorID' : '1',
				'paperID' : '1',
				'planoID' : '1'
			};
			$scope.unittypenames = [
				{
					"label" : "kilograms",
					"value" : "kg"
				},
				{
					"label" : "lembar",
					"value" : "lbr"
				},
				{
					"label" : "meter",
					"value" : "m"
				},
				{
					"label" : "centimeter",
					"value" : "cm"
				}
			];
			$scope.totaltypenames = [
				{
					"label" : "rim",
					"value" : "rim"
				},
				{
					"label" : "pack",
					"value" : "pack"
				},
				{
					"label" : "roll",
					"value" : "roll"
				},
				{
					"label" : "plano",
					"value" : "plano"
				}
			];

			$scope.initData = function($input){
				$scope.paperdetails = JSON.parse($input);
			}
			$scope.searchPaper = function(){
				if ($scope.searchingkey == "")
				{
					$scope.searchedpapers = $scope.papers;
				}
				else
				{
					$scope.searchedpapers = [];
					for($i=0,$index=0;$i<$scope.papers.length/*&&$index<20*/;$i++)
					{
						console.log($scope.papers[$i]['papertypename']);
						if($scope.isContained($scope.papers[$i]['name'], $scope.searchingkey) == true
							|| $scope.isContained($scope.papers[$i]['papertypename'], $scope.searchingkey) == true
							|| $scope.isContained($scope.papers[$i]['vendorname'], $scope.searchingkey) == true)
						{
							$scope.searchedpapers.push($scope.papers[$i]);
							$index++;
						}
					}
				}
			}

			$scope.setSelectedPaper = function($checked, $item){
				$flag = 0;
				for ($i = ($scope.currentPage-1)*$scope.itemsPerPage; $i < $scope.currentPage*$scope.itemsPerPage; $i++) {
					if ($scope.searchedpapers[$i].checked)
						$flag=$flag+1;
				}
				if ($flag == 0)
				{	
					$("#allchecked").prop("indeterminate", false);
					$scope.allchecked = false;
				}
				else if ($flag == $scope.itemsPerPage)
				{	
					$("#allchecked").prop("indeterminate", false);
					$scope.allchecked = true;
				}
				else
				{
					$("#allchecked").prop("indeterminate", true);
					$scope.allchecked = false;
				}
				//console.log($item);
				$scope.selectedpaper = $item.paperdetail;
			}

			$scope.setPrice = function(){
				$scope.data = [];
				for ($i = 0; $i < $scope.searchedpapers.length; $i++) {
					if ($scope.searchedpapers[$i].checked)
						$scope.data.push($scope.searchedpapers[$i].id);
				}
				if ($scope.newprice != null) 
				{
					$http(
						{
							'method' : 'POST',
							'url' 	 : API_URL+"paperdetails/setprice",
							'data' 	 : 
							{
								'ids' : $scope.data,
								'price' : $scope.newprice,
								'shopID' : $scope.shopID
							}
						}
					).then(function(response){
						//console.log(response);
						//$scope.searchingkey = "";
						$scope.papers = response.data;
						$scope.searchPaper();
					},function(error){});
				}
				else
				{
					$scope.errormessage="New price cannot be null";
				}
			}

			$scope.URL = 'http://localhost:8000/';
			$scope.setFromValue = function($paperdetail){
				$scope.selected = $paperdetail;
				console.log($paperdetail);

				$('#btn-add').attr('hidden', 'hidden');
				$('#btn-cancel').removeAttr('hidden');
				$('#btn-update').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
				$('#form-open').attr('action', $scope.URL+'paperdetails/'+$paperdetail.paperID+'/'+$paperdetail.vendorID);
				$('#form-method').val('PUT');
				$('#form-id').val($paperdetail.id);

			};
			$scope.cancelUpdate = function(){
				$('#btn-cancel').attr('hidden', 'hidden');
				$('#btn-add').removeAttr('hidden');
				$('#btn-update').removeClass('btn-primary').addClass('btn-second').attr('disabled', 'disabled');
				$('#form-open').attr('action', $scope.URL+'paperdetails');
				$('#form-method').val('POST');
			}

			$scope.isContained = function($string, $key){
				if ($string == null) return false;
				if ($key == null) return true;
				if ($string.toLowerCase().indexOf($key.toLowerCase()) != -1)
					return true;
				else
					return false;
			};

			$scope.fillPapers = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'papers'
					}
				).then(function(response) {
					$scope.papers = response.data;
					$('#form-paperID').children().remove();
				});
			};
			$scope.fillPapers.call();

			$scope.fillPapersizes = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'papersizes'
					}
				).then(function(response) {
					$scope.papersizes = response.data;
					$('#form-papersizeID').children().remove();
				});
			};
			$scope.fillPapersizes.call();

			$scope.fillPapershops = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'vendors'
					}
				).then(function(response) {
					$scope.vendors = response.data;
					$('#form-vendorID').children().remove();
				});
			};
			$scope.fillPapershops.call();


			$scope.currentPage = 1;
			$scope.itemsPerPage = 10;

			$scope.selectAllInCurrent = function($check){
				for ($i = 0; $i < $scope.searchedpapers.length; $i++) {
					$scope.searchedpapers[$i].checked = false;
				}
				if ($check)
					for ($i = ($scope.currentPage-1)*$scope.itemsPerPage; $i < $scope.currentPage*$scope.itemsPerPage; $i++) {
						$scope.searchedpapers[$i].checked = true;
					}
			}
			$scope.setAllChecked = function($checked){
				$scope.selectAllInCurrent($checked);
			}

			$scope.pageChangeHandler = function(num) {
					$scope.currentPage = num;
			};
		}
	]);
};