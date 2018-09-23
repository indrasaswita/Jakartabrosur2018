module.exports = function(app){
	app.controller('HandOfGod', ['$timeout', '$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($timeout, $scope, $http, API_URL, BASE_URL, $window){
			$scope.godSalesID = 0;
			$scope.subnavs = [
				{
					link		: BASE_URL+'orderlistcustomer',
					route		: ['orderlistcustomer'],
					label 		: 'Order List',
					glyphicon 	: 'fa-th'
				},
				{
					link		: BASE_URL+'orderlistcustomer',
					route		: ['shop', 'shop/{pages}'],
					label 		: 'Selection',
					glyphicon 	: 'fa-crosshairs'
				},
				{
					link		: BASE_URL+'cart',
					route		: ['cart', 'cart/{cart}'],
					label 		: 'Keranjang Belanja',
					glyphicon 	: 'fa-shopping-basket'
				},
				{
					link		: BASE_URL+'sales/all',
					route		: ['sales/all', 'payment', 'payment/{payment}', 'payment/confirm', 'payment/confirm/{id}', 'addresses', 'addresses/{addresses}'],
					label 		: 'Proses & Pembayaran',
					glyphicon 	: 'fa-shopping-bag'
				}/*,
				{
					link		: BASE_URL+'tracking',
					route		: ['tracking'],
					label 		: 'Tracking',
					glyphicon 	: 'fa-tasks'
				},
				{
					link		: BASE_URL+'sales/history',
					route		: ['sales/history'],
					label 		: 'History',
					glyphicon 	: 'fa-history'
				}*/
			];
			$scope.salenavs = [
				{
					link 		: BASE_URL+'sales/all',
					route		: 'sales/all',
					label		: 'Semua Daftar',
					label2		: 'All Sales',
					icon		: ''
				},
				{
					link 		: BASE_URL+'sales/waitingpayment',
					route		: 'sales/waitingpayment',
					label		: 'Tunggu Pembayaran',
					label2		: '',
					icon		: ''
				},
				{
					link 		: BASE_URL+'sales/waitingverif',
					route		: 'sales/waitingverif',
					label		: 'Belum di Verif',
					label2		: 'Waiting Verification',
					icon		: ''
				},
				{
					link 		: BASE_URL+'sales/onprocess',
					route		: 'sales/onprocess',
					label		: 'Dalam Pencetakan',
					label2		: 'On Process',
					icon		: ''
				},
				{
					link 		: BASE_URL+'sales/history',
					route		: 'sales/history',
					label		: 'Sudah Selesai',
					label2		: 'History',
					icon		: ''
				}
			];

			$scope.reversestatus = function($input){
				if(typeof($input) === "boolean")
					return !$input;
			}
			$scope.globalSalesID = function($salesID){
				$scope.salenavs[1].link = BASE_URL+'payment/'+$salesID;
				$scope.salenavs[2].link = BASE_URL+'addresses/'+$salesID;
				$scope.salenavs[3].link = BASE_URL+'payment/confirm/'+$salesID;
			}
			$scope.globalSubnav = function($current){
				$scope.subnavbefore = [];
				$scope.subnavafter = [];
				$scope.subnavcurrent = null;
				$after = false;
				$.each($scope.subnavs, function($index, $item){
					if(!$scope.isInside($current, $item.route))
					{
						if($after==false)
						{
							$scope.subnavbefore.push($item);
						}
						else
						{
							$scope.subnavafter.push($item);
						}
					}
					else
					{
						$after = true;
						$scope.subnavcurrent = $item;
					}
				});
			}
			$scope.isInside = function($current, $arr){
				$result = false;
				$.each($arr, function($index, $item){
					//console.log($current +", "+ $item);
					if($current == $item)
					{
						$result = true;
						return false;
					}
				});
				return $result;
			}
			$scope.globalSubnav();

			$scope.role = function($role, $custID){
				if($role!=null){
					if($role == 'customer'){
						$scope.notifcounting('customer', $custID);
					}else if($role != 'customer' && $role != ''){
						$scope.notifcounting('employee', $custID);
					}
				}
			}

			$scope.notifcount = 0;
			$scope.notifcounting = function($role, $custID){
				$scope.notifcount = 0;
				$http({
					method: "POST",
					url: API_URL+'notifications/'+$role+'/'+$custID+'/count'
				}).then(function(response){
					if(response.data != null){
						if(response.data.constructor === String){
							$scope.notifcount = parseInt(response.data);
						}else{
							console.log('error');
						}
					}
				});
			}

			$(document).ready(function(){
				$('#preloader-wrapper').hide();
				$('#content-wrapper').fadeIn();
			});


			//$scope.webNotification = new Notification("HELLO WORLD");
			document.addEventListener('DOMContentLoaded', function () {
				if (!Notification) {
				console.log('Desktop notifications not available in your browser. Try for the newer version.'); 
				return;
				}

				if (Notification.permission !== "granted")
				Notification.requestPermission();
			});

			$scope.haha = function () {
				if (Notification.permission !== "granted")
				Notification.requestPermission();
				else {
					var notification = new Notification('New Cart', {
						icon: BASE_URL+"image/location-ok.png",
						body: "Ada Cart Baru",
						dir: 'ltr',
						tag: 'hello',
					});
					setTimeout(notification.close.bind(notification), 99999999);

					notification.onclick = function () {
						window.open("http://stackoverflow.com/a/13328397/1269037");      
					};

				}
			}

			$scope.singkatText = function($text, $totalhuruf, $simbolakhir)
			{
				if($text == null || $totalhuruf == null || $simbolakhir == null)
					return '-';
				if($simbolakhir == '')
				{
					return $scope.singkatText0($text, $totalhuruf);
				}
				else
				{
					if($text.length > $totalhuruf)
					{
						$indexSimbol = $text.lastIndexOf($simbolakhir)-2;
						$panjangAkhir = $text.length - $indexSimbol;
						$panjangDepan = ($totalhuruf - $panjangAkhir < 5 ? 5 : $totalhuruf - $panjangAkhir);
						$depan = $text.substring(0, $panjangDepan);
						$belakang = $text.substring($indexSimbol);
						return $depan+"..."+$belakang;
					}
					else
					{
						return $text;
					}
				}
			}

			String.prototype.toTitleCase = function () {
			  	return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
			};

			$scope.togglerClicked = function(){
				$timeout(function(){
					if ($('.navbar-toggler').attr('aria-expanded') === 'true') {
						$('.navbar-toggler .fa').addClass("rotate");
						$('.navbar-toggler .glyphicon').addClass("rotate");
					}else if($('.navbar-toggler').attr('aria-expanded') === 'false') {
						$('.navbar-toggler .fa').removeClass("rotate");
						$('.navbar-toggler .glyphicon').removeClass("rotate");
					}
				});
			}

			$scope.singkatText0 = function($text, $totalhuruf)
			{
				if($text==null)
					return '-';
				if($text.length > $totalhuruf)
				{
					$depan = $text.substring(0, $totalhuruf);
					return $depan+"...";
				}
				else
				{
					return $text;
				}
			}

			$scope.getActiveJobSubType = function(){
				$http(
					{
						method : 'GET',
						url : API_URL + 'jobsubtypes/getactive'
					}
				).then(
					function(response) {
						$scope.jobtypes = response.data;
					},function(error){
						console.log("Error (GodHand.js) : " + response.data);
					}
				);
			}

			$scope.afterAngular = function(){
				$scope.selectpickerrefresh();
			}

			$scope.selectpickerrefresh = function($tmot){
				$tmot(function(){
					$('.selectpicker').selectpicker('refresh');
				});
			}

			$scope.clone = function($obj){
				return jQuery.extend(true, {}, $obj);
			};

			$scope.isNum = function($input){
				return !isNaN($input);
			}
			
			$scope.zeroFill = function ( number, width )
			{
				if (number == null) return "null";
				width -= number.toString().length;
				if ( width > 0 )
				{
					return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
				}
				return number + ""; // always return a string
			}

			$scope.makeDate = function($input){
				if ($input == null) return null;
				if ($input == 'null') return null;
				$temp = $input.split(' ')[0];
				$temp = $temp.split('-');
				return new Date($temp[0], $temp[1]-1, $temp[2]);
			}

			$scope.makeDateTime = function($input){
				if ($input == null) return null;
				if ($input == 'null') return null;
				$temp = $input.split(' ')[0];
				$temp = $temp.split('-');
				$temp2 = $input.split(' ')[1];
				$temp2 = $temp2.split(':');
				return new Date($temp[0], $temp[1]-1, $temp[2], $temp2[0], $temp2[1], $temp2[2]);
			}
			Date.prototype.getDateOnly = (function() {
				var local = new Date(this);
				local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
				return local.toJSON().slice(0,10);
				//PAKENYA : new Date().getDateOnly()
				//HASILNYA : 2017-07-17
			});
			$scope.num_validation = function( $value, $min, $max, $step )
			{
				if($value > $max)
				{
					$value = $max;
				}
				else if($value < $min)
				{
					$value = $min;
				}
				else
				{
					$a = 1 / $step;
					$b = $value * $a;
					$c = parseInt($b);
					if($b != $c)
					{
						$value=$c/$a;
					}
				}

				return $value;
			}

			$scope.print_r = function (o){
				return JSON.stringify(o,null,'\t'); 
			}


			$scope.fillPapers = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'papers'
					}
				).then(function(response) {
					if(response.data!=null)
						if(response.data.length>0)
							$scope.papers = response.data;
					//$('#form-paperID').children().remove();
				});
			};

			// $scope.fillCities = function()
			// {
			// 	$http(
			// 		{
			// 			method : 'GET',
			// 			url : API_URL + 'cities'
			// 		}
			// 	).then(function(response) {
			// 		if(response.data!=null)
			// 			if(response.data.length>0)
			// 				$scope.cities = response.data;
			// 	});
			// };

			$scope.fillCompanyBankAccs = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'compaccs'
					}
				).then(function(response) {
					$scope.compaccs = response.data;
					if(response.data!=null){
						if(response.data.length>0)
							$scope.showncompacc = $scope.compaccs[0];
					}
				});
			};

			$scope.copyToClipboard = function(containerid){
				if (document.selection) { 
					var range = document.body.createTextRange();
					range.moveToElementText(document.getElementById(containerid));
					range.select().createTextRange();
					document.execCommand("copy");

				} else if (window.getSelection) {
					var range = document.createRange();
					range.selectNode(document.getElementById(containerid));
					window.getSelection().addRange(range);
					document.execCommand("copy");
				}
			}

			$scope.tooltip=function($value){
				$scope.statictooltipvalue=$value;
			}
		}
	]);
}