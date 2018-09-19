module.exports = function(app){
	app.controller('PaymentController', ['$scope', '$http', 'API_URL', '$window',
		function($scope, $http, API_URL, $window){
			$scope.URL = 'http://localhost:8000/';
			$scope.bates = new Date(2016, 01, 01);
			$scope.initSales = function($input){
				$scope.allsales = JSON.parse($input);
				$scope.allsales.created_at = $scope.makeDateTime($scope.allsales.created_at+"");
				$scope.allsales.estdate = $scope.makeDate($scope.allsales.estdate+"");
				for($i=0;$i<$scope.allsales.delivery.length;$i++)
				{
					$scope.allsales.delivery[$i].arrivedtime = $scope.makeDateTime($scope.allsales.delivery[$i].arrivedtime+"");
					$scope.allsales.delivery[$i].updated_at = $scope.makeDateTime($scope.allsales.delivery[$i].updated_at+"");
				}
				$scope.countTotal();
			}
			$scope.countTotal = function(){
				$scope.totalprice = 0;
				for($i=0;$i<$scope.allsales.details.length;$i++)
					$scope.totalprice += parseFloat($scope.allsales.details[$i].totalprice);
				if($scope.allsales.delivery.length == 1)
					$scope.totalprice += parseFloat($scope.allsales.delivery[0].price);
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

			$scope.makeDate = function($input){
				if ($input == null) return null;
				if ($input == 'null') return null;

				$temp = $input.split(' ')[0];
				$temp = $temp.split('-');
				return new Date($temp[0], $temp[1]-1, $temp[2]);
			}

			$scope.makeDateTime = function($input){
				//console.log($input+ " : "+($input == 'null'));
				if ($input == 'null') return null;
				$temp = $input.split(' ')[0];
				$temp = $temp.split('-');
				$temp2 = $input.split(' ')[1];
				$temp2 = $temp2.split(':');
				return new Date($temp[0], $temp[1]-1, $temp[2], $temp2[0], $temp2[1], $temp2[2]);
			}
		}
	]);
};