module.exports = function(app){
	app.controller('HandOfGod', ['$timeout', '$scope', '$http', 'API_URL', 'BASE_URL', '$window', '$sce',
		function($timeout, $scope, $http, API_URL, BASE_URL, $window, $sce){
			$scope.godSalesID = 0;

			/*Global site tag (gtag.js) - Google Analytics */
			// ============================================
			$window.dataLayer = $window.dataLayer || [];
			$scope.gtag = function(){
				dataLayer.push(arguments);
			}

			$scope.gtag('js', new Date());
			$scope.gtag('config', 'UA-144197477-1');
			// ==========================================
			/*Global site tag (gtag.js) - Google Analytics */


			$scope.showAlertOK = function($title, $detail, $login = false){
				$scope.alertmessage = {
					'title': $title,
					'detail': $detail,
					'login': $login //untuk show button login (if true)
				};
				$('#alert-ok').modal('show');
			}

			$scope.reversestatus = function($input){
				if(typeof($input) === "boolean")
					return !$input;
			}
			
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

			$scope.timecount = 0;

			var interval = setInterval(function() {
				$scope.timecount = 0;
				console.log("COUNTER: " + $scope.timecount);
				$scope.timecount++;
			}, 10);

			$(document).ready(function(){
				$('#preloader-wrapper').hide();
				clearInterval(interval);
				$('#content-wrapper').fadeIn();
				try{
					$('#landingpage').modal('show'); //dihome page
				}catch(e){
					console.log("Landing page error - runtime error");
				}
			});


			$scope.singkatText = function($text, $totalhuruf, $simbolakhir)
			{
				$hasil = "";

				if($text == null || $totalhuruf == null || $simbolakhir == null)
					return '-';
				if($simbolakhir == '')
				{
					$hasil = $scope.singkatText0($text, $totalhuruf);
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
						$hasil = $depan+"..."+$belakang;
					}
					else
					{
						$hasil = $text;
					}
				}

				if($hasil.length > $totalhuruf+3){
					$hasil = $scope.singkatText0($text, $totalhuruf);
				}

				return $hasil;
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

			/*$scope.afterAngular = function(){
				$scope.selectpickerrefresh();
			}

			$scope.selectpickerrefresh = function($tmot){
				$tmot(function(){
					$('.selectpicker').selectpicker('refresh');
				});
			}*/

			$scope.clone = function($obj){
				//GA BISA BUAT ARRAY
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

			$scope.fillCities = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'cities'
					}
				).then(function(response) {
					if(response.data!=null)
						if(response.data.length>0)
							$scope.cities = response.data;
				});
			};

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

			$scope.validateEmail = function(email) {
				var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(email);
			}

			$scope.tooltip=function($value){
				$scope.statictooltipvalue=$value;
			}

			$scope.updateCompAcc = function($accid){
				$http({
					"method":"GET",
					"url":"https://api.ipify.org"
				}).then(function(response){
					if(response.data!=null){
						if(response.data.constructor === String){
							//return IP
							$http({
								"method":"POST",
								"url":API_URL+"admin/compaccs/"+$accid+"/bca/refresh",
								"data":response.data
							}).then(function(response2){
								if(response2.data != null){

									$.each(response2.data, function($index, $item){
										$item.mutationDate = $scope.makeDate($item.mutationDate);
									});

									$scope.klikbca = response2.data;
								}
							}).catch(function(data){
								$scope.klikbca = data.data.message;
							});
						}else{
							$scope.klikbca = null;
						}
					}else{
						$scope.klikbca = null;
					}
				});
			}

			String.prototype.replaceAll = function(search, replacement) {
				var target = this;
				return target.replace(new RegExp(search, 'g'), replacement);
			}

			$scope.trustAsHtml = function($input){
				return ($sce.trustAsHtml($input).$$unwrapTrustedValue().replaceAll(/\?/g, '\''));
			}

			$scope.isURL = function(value) {
			  return /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(value);
			}

			$scope.trustAsUrl = function($input){
				return $sce.trustAsResourceUrl($input);
			}

			$scope.stripTagsWA = function($input){
				$hasil = $input.replace(/<br\s*\/?>/ig, '%0A'); //buat replace br jadi 1x enter
				$hasil = $hasil.replace(/<hr[^>]*>/ig, '%0A%0A'); //buat replace hr jadi 2x enter
				$hasil = $hasil.replace(/<b[^>]*>|<\/b>/ig, '*'); //buat b dan /b jadi *
				$hasil = $hasil.replace(/[ \t]/ig, '%20'); //buat replace hr jadi 2x enter
				$hasil = $hasil.replace(/&sup2;/ig, '2'); //kuardrat jadi 2
				$hasil = $hasil.replace(/(<([^>]+)>)/ig, ''); //buat replace semua html tag jadi hilang
				return $hasil;
			}

			$scope.DateDiff = {
				inDays: function (d1, d2){
					var t2 = d2.getTime();
					var t1 = d1.getTime();
					return parseInt((t2-t1)/(24*3600*1000));
				},
				inWeeks: function(d1, d2) {
					var t2 = d2.getTime();
					var t1 = d1.getTime();
					return parseInt((t2 - t1) / (24 * 3600 * 1000*7));
				},
				inMonths: function(d1, d2) {
					var d1Y = d1.getFullYear();
					var d2Y = d2.getFullYear();
					var d1M = d1.getMonth();
					var d2M = d2.getMonth();
					return (d2M+12*d2Y)-(d1M+12*d1Y);
				},
				inDays: function(d1, d2) {
					var d1Y = d1.getFullYear();
					var d2Y = d2.getFullYear();

					return d2Y-d1Y;
				}
			}

			$scope.ceil = function($input){
				return Math.ceil($input);
			}
			$scope.floor = function($input) {
				return Math.floor($input);
			}
			$scope.round = function($input) {
				return Math.round($input);
			}
 			//perhitungan dan pakai di admin.master.paper.paperdetailstore.js
			$scope.total2kg = function($total, $gram, $w, $l) {
				$result = $total * 20000 / $gram / $w / $l;
				return Math.round($result / 100) * 100;
			}
			$scope.total2unit = function($total, $totalpcs) {
				$result = $total / $totalpcs;
				return Math.ceil($result);
			}
			$scope.kg2total = function($kg, $gram, $w, $l) {
				$result = $kg * $gram * $w * $l / 20000;
				return Math.ceil($result / 1000) * 1000;
			}
			$scope.kg2unit = function($kg, $gram, $w, $l) {
				$result = $kg * $gram * $w * $l / 20000 / 500;
				return Math.ceil($result);
			}
			$scope.unit2total = function($unit, $totalpcs) {
				$result = $unit * $totalpcs;
				return $result;
			}
			$scope.unit2kg = function($unit, $totalpcs, $gram, $w, $l) {
				$total = $unit * $totalpcs;
				$result = $total * 20000 / $gram / $w / $l;
				return Math.round($result / 100) * 100;
			}

			$scope.filteremptyindex = function($arr){
				//CLEAR INDEX CLEAR EMPTY INDEX DELETE EMPTY ARRAY APUS EMPTY
				return $arr.filter(value => Object.keys(value).length !== 0);
			}

			$scope.phonemask = function(e){
				// REGEX PHONE
				if(e!=null){
					var hasil = e;
					var x;
					if(!e.startsWith("08")){
					  x = e.replace(/\D/g, '').match(/(\d{3})(\d{3})(\d{4})/);
					  if(x!=null)
					  	hasil = '(' + x[1] + ') ' + x[2] + '-' + x[3];
					}
					else{
						if(e.length==10){
							x = e.replace(/\D/g, '').match(/(\d{4})(\d{3})(\d{3})/);
							if(x!=null)
					  		hasil = x[1] + '-' + x[2] + '-' + x[3];
						}else if(e.length==11){
							x = e.replace(/\D/g, '').match(/(\d{4})(\d{3})(\d{4})/);
							if(x!=null)
					  		hasil = x[1] + '-' + x[2] + '-' + x[3];
						}
						else if(e.length==12){
							x = e.replace(/\D/g, '').match(/(\d{4})(\d{4})(\d{4})/);
							if(x!=null)
					  	hasil = x[1] + '-' + x[2] + '-' + x[3];
						}
						else if(e.length==13){
							x = e.replace(/\D/g, '').match(/(\d{4})(\d{4})(\d{4})(\d{4})/);
							if(x!=null)
								hasil = x[1] + '-' + x[2] + '-' + x[3] + '-' + x[4];
						}
					}
				  return hasil;
				}else
					return "";
			}
		}
	]);
}