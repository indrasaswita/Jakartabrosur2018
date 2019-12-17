
module.exports = function(app){
	app.controller('OrderShopCalculationController', ['$timeout', '$scope', '$http', 'AJAX_URL', 'API_URL', 'BASE_URL', '$window',
		function($timeout, $scope, $http, AJAX_URL, API_URL, BASE_URL, $window){

			//INIT DATA SELECTED
			$scope.selected = {
				'paper': 0,
				'size' : 0,
				'printtype' : 'DG',
				'sideprint' : 1,
				'processtime' : 'std',
				'reseller' : 'std',
				'perbungkus' : "1000",
				'imagewidth' : '21',
				'imagelength' : '29.7',
				'jobsubtypeID' : -1,
				'jobtitle' : '',
				'customernote' : '',
				'itemdescription' : '',
				'customernote' : '',
				'resellerphone' : '',
				'resellername' : '',
				'reselleraddress' : '',
				'files' : [],
				'finishings' : [],
				'deliveryaddress': ''
			};
			$scope.newaddress = {
				'name':"",
				'note':"",
				'location':"",
				'city':[]
			}
			$scope.selectedTab = '';

			$scope.texttoread = '';
			$scope.textcombination = '';
			
			$finishchanging = false;
			$scope.counter = 0;
			$scope.underconstruction = false;
			$scope.uploadwaiting = false;
			$scope.uploadsuccess = false;
			$scope.customsize = false;
			$scope.result = {
				"total" : {
					"price" : 0,
					"deliv" : 0,
					"stdest" : '-',
					"expest" : '-',
					"weight" : 0,
				}
			};
			$scope.userid = null;
			$scope.role = null;
			$scope.uploadedfiles = [];
			$scope.error = {
				"files" : "",
				"savecart" : "",
				"savecartval" : "",
				'savebtnval' : "",
				"description" : "",
				"upload": "",
			};
			$scope.total = [];
			$scope.uploadmaxfilesize = 26214400;
			$scope.newfiledetail = "";

			$scope.setInputFilter = function(textbox, inputFilter) {
			  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
			    textbox.oldValue = "";
			    textbox.addEventListener(event, function() {
			      if (inputFilter(this.value)) {
			        this.oldValue = this.value;
			        this.oldSelectionStart = this.selectionStart;
			        this.oldSelectionEnd = this.selectionEnd;
			      } else if (this.hasOwnProperty("oldValue")) {
			        this.value = this.oldValue;
			        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			      }
			    });
			  });
			}

			// Restrict input to digits and '.' by using a regular expression filter.
			$scope.setInputFilter(document.getElementById("quantity"), function(value) {
			  return /^\d*$/.test(value);
			});
			$scope.setInputFilter(document.getElementById("customwidth"), function(value) {
			  return /^\d*\.?\d*$/.test(value);
			});
			$scope.setInputFilter(document.getElementById("customlength"), function(value) {
			  return /^\d*\.?\d*$/.test(value);
			});

			$(document).ready(function() {
				$scope.selectTab("calculation");
				var url = document.location.toString();
				if (url.match('#')) {
					var temp = url.split('#')[2];
					if(temp == "calculation" ||
						temp == "description" ||
						temp == "file"){
						$scope.selectTab(temp);
					}
				}
			});

			$scope.selectTab = function($tab){
				if($scope.selected.cartID != null && $tab == "file"){
					$scope.selectedTab = "calculation";
				}else{
					$scope.selectedTab = $tab;
				}
			}

			$scope.setUserLogin = function($role, $userid)
			{
				if ($userid != null) {
					$scope.userid = $userid;
				}
				if($role==null){
					$scope.role = null;
					$scope.restrictNotLogined();
				}else if($role==''){
					$scope.role = null;
					$scope.restrictNotLogined();
				}else if($role!='customer'){
					$scope.role = "employee";
					$scope.restrictNotCustomer();
				}else
				{
					$scope.role = "customer";
					$scope.allowed();
				}
			}

			$scope.checkIfMin = function($input, $min){
				if($input == null)
					return 0;
				else if($input == "")
					return $min;
				else if($input < $min)
					return $min;
				else
					return $input;

				$scope.getPrice();
			}

			$scope.setSelectedByURL = function($input){
				$tmps = JSON.parse($input);
				$finclone = $scope.clone($scope.selected.finishings);

				$scope.selected = Object.assign($scope.selected, $tmps);
				$scope.datas = $scope.splitMaster($scope.master, $scope.selected.printtype);
				$scope.setFinishingRole();
				$scope.selected.finishings = $tmps.finishings;

				//SELECT SIZE
				$.each($scope.datas.jobsubtypesize, function($i, $ii){
					if($ii.size.id == $scope.selected.sizeID){
						$scope.selected.size = $ii.size;
					}
				});
				//SELECT JENIS MATERIAL
				$.each($scope.datas.jobsubtypepaper,function($i, $ii){
					if($ii.paper.id == $scope.selected.paperID){
						$scope.selected.paper = $ii.paper;
					}
				});
				//SELECT SISI CETAK
				//sudah langsung cek ke sideprint: 1/2
				//SELECT FINISHING
				$.each($scope.datas.jobsubtypefinishing, function($i, $ii){
					//$s <- dari url (selected)
					$tidakadadiurl = true;
					$.each($scope.selected.finishings, function($s, $ss){
						if($ss.finishingID == $ii.finishing.id){
							//jika finishing idnya sama, brarti indexnya ketemu juga.. maka di cek optionnya..
							$tidakadadiurl = false;
							$tidakadasama = true;
							$.each($ii.finishing.finishingoption, function($j, $jj){
								if($jj.id == $ss.optionID){
									//jika optionnya di looping dan idnya ketemu, maka hasilnya di tampung.. selected.finsihings[$s]nya diganti jadi object
									$scope.selected.finishings[$s] = $scope.clone($jj);
									$tidakadasama = false;
								}
								//jika tidak ada yang sama satu pun maka masuk ke bawah
							});
							//jika tidak ada yang sama
							if($tidakadasama == true){
								//jika optionID tidak ada: error, maka dimasukkan default
								$scope.selected.finishings[$s] = $scope.clone($finclone[$s]);
								//finclone sudah di copy di awal
							}
						}
					});
					if($tidakadadiurl == true){
						$scope.selected.finishings[$i] = $scope.clone($finclone[$i]);
					}
				});
				//SELECT DELIVERY TYPE
				$dlvfound = false;
				$.each($scope.deliveries, function($i, $ii){
					if($ii.id == $scope.selected.deliveryID){
						$scope.selected.delivery = $ii;
						$dlvfound = true;
						if($ii.id != 0){
							$scope.fillCities();
							//kalo bukan pick up di fill cities buat tambah address;
						}
					}
				});
				if($dlvfound){
					$.each($scope.customeraddresses, function($i, $ii){
						if($ii.addressID == $scope.selected.deliveryaddressID){
							if($ii.id != 0)
								$scope.selected.deliveryaddress = $ii;
							else{
								$scope.selected.deliveryaddress = "";
							}
						}
					});
				}else{
					$scope.selected.deliveryaddress = "";
				}
				
				if($scope.customeraddresses!=null){
					if ($scope.selected.deliveryaddress == "") {
						if ($scope.customeraddresses.length > 0) {
							$scope.selected.deliveryaddress = $scope.customeraddresses[0];
						}
					}
				}

				//FILE DI SELECT PAS DI AJAX, SOALNYA SAMPE TAHAP INI BELOM KE LOAD ($scope.refreshUploadedImage)

				//kalo ada cartID -> berarti edit data
				//matiin file
				$("#file-headtab").parent().hide();
				$scope.getPrice();
			}

			$scope.sendUrl = function(){
				window.open("https://api.whatsapp.com/send?text=Silahkan di cek di%0A%0A"+encodeURIComponent($scope.getCurrentURL()), "_blank");
			}

			$scope.getCurrentURL = function(){
				$tmps = $scope.clone($scope.selected);


				//RAPIHIN FILE
				$tmpfl = [];
				$.each($tmps.files, function($i, $ii){
					$temp = {
						"fileID": $ii.id
					}
					$tmpfl.push($temp);
				});
				delete $tmps.files;
				$tmps.files = $tmpfl;

				//RAPIHIN FINISHING + OPTION
				$tmpsf = [];
				$.each($tmps.finishings, function($i, $ii){
					$temp = {
						"finishingID": $ii.finishingID,
						"optionID": $ii.id
					};
					$tmpsf.push($temp);
				});
				delete $tmps.finishings;
				$tmps.finishings = $tmpsf;


				$tmps.deliveryaddressID = $tmps.deliveryaddress.addressID;
				delete $tmps.deliveryaddress;
				$tmps.sizeID = $tmps.size.id;
				delete $tmps.size;
				$tmps.deliveryID = $tmps.delivery.id;
				delete $tmps.delivery;
				$tmps.paperID = $tmps.paper.id;
				delete $tmps.paper;
				$link = $tmps.jobsubtypelink;
				delete $tmps.jobsubtypelink;

				if($tmps.resellername == ""){
					delete $tmps.resellername;
					delete $tmps.resellerphone;
					delete $tmps.reselleraddress;
				}

				$addurl = JSON.stringify($tmps);
				$base = BASE_URL=='/jakartabrosur/public/'?'localhost'+BASE_URL:'www.jakartabrosur.com/';
				$addurl = $base+"shop/"+$link+"?ss="+$addurl;
				
				$scope.copyToClipboard($addurl);
				return $addurl;
			}

			$scope.restrictNotLogined = function()
			{
				$scope.error.message = "Anda harus login untuk upload file!";
			}

			$scope.restrictNotCustomer = function()
			{
				$scope.error.message = "Login Sebagai Customer Untuk Pesan!";
			}

			$scope.allowed = function()
			{
				$scope.error.message = "";
			}

			$scope.changeDetailName = function($datas){
				//SET FINISHING DATA + Paper
				$datas.jobsubtypedetail = [];
				$.each($datas.jobsubtypedetail, function($index, $item){
					$datas.jobsubtypedetail[$index] = $scope.changeFinishingDetailName($item);
					$datas.jobsubtypedetail[$index] = $scope.changePaperDetailName($item);
				});
					

				delete $datas.jobsubtypedetail;

				return $datas;
			}

			$scope.changeFinishingDetailName = function($detail){
				$detail.jobsubtypedetailfinishing = $detail.jobsubtypedetailfinishingshop;
				delete $detail.jobsubtypedetailfinishingshop;

				$.each($detail.jobsubtypedetailfinishing, function($index, $item){
					$detail.jobsubtypedetailfinishing[$index].finishing = $item.finishingshop;
					delete $item.finishingshop;
					$detail.jobsubtypedetailfinishing[$index].finishing.finishingoption = $detail.jobsubtypedetailfinishing[$index].finishing.finishingoptionshop;
					delete $detail.jobsubtypedetailfinishing[$index].finishing.finishingoptionshop;
				});

				return $detail;
			}

			$scope.changePaperDetailName = function($detail){
				$detail.jobsubtypedetailpaper = $detail.jobsubtypedetailpapershop;
				delete $detail.jobsubtypedetailpapershop;

				$.each($detail.jobsubtypedetailpaper, function($index, $item){
					$detail.jobsubtypedetailpaper[$index].paper = $item.papershop;
					delete $item.papershop;
					$detail.jobsubtypedetailpaper[$index].paper.paperoption = $detail.jobsubtypedetailpaper[$index].paper.paperoptionshop;
					delete $detail.jobsubtypedetailpaper[$index].paper.paperoptionshop;
				});

				return $detail;
			}

			$scope.changeFinishingName = function($datas){
				$datas.jobsubtypefinishing = $datas.jobsubtypefinishingshop;
				delete $datas.jobsubtypefinishingshop;

				$.each($datas.jobsubtypefinishing, function($index, $item){
					$datas.jobsubtypefinishing[$index].finishing = $item.finishingshop;
					delete $item.finishingshop;
					$datas.jobsubtypefinishing[$index].finishing.finishingoption = $datas.jobsubtypefinishing[$index].finishing.finishingoptionshop;
					delete $datas.jobsubtypefinishing[$index].finishing.finishingoptionshop;
				});

				return $datas;
			}

			$scope.changePaperName = function($datas){
				$datas.jobsubtypepaper = $datas.jobsubtypepapershop;
				delete $datas.jobsubtypepapershop;

				$.each($datas.jobsubtypepaper, function($index, $item){
					$datas.jobsubtypepaper[$index].paper = $item.papershop;
					delete $item.papershop;
				});

				return $datas;
			}

			$scope.deleteUnused = function(){
				//delete $scope.selected.pagename;
				//delete $scope.selected.satuan;
				delete $scope.selected.imagewidth;
				delete $scope.selected.imagelength;
				//IMAGE SIZE benernya ada di array $scope.selected.size

				delete $scope.datas.active;

			}

			$scope.addtambahbaruaddress = function(){
				$scope.customeraddresses.push( 
					{
						"id": '0',
						"address":{
							"name": "Add address",
							"address": "Tambah alamat baru.."
						}
					}
				);
			}

			$scope.setData = function($datas){
				//untuk set address di description kalo uda login
				if($datas.user != null){
					$scope.customeraddresses = [];
					if($datas.user.customeraddress.length>0){
						//kalo > 0 brarti ada data di customer addressesnya
						$scope.customeraddresses = $datas.user.customeraddress;
						$scope.selected.deliveryaddress = $scope.customeraddresses[$scope.customeraddresses.length-1];
					}else{
						$scope.selected.deliveryaddress = '';
					}
					$scope.addtambahbaruaddress();
					$scope.getMaxFilesize();
					$scope.refreshUploadedImage();
				}

				//SET DATA PAPER YANG GA ADA DETAIL GA BOLEH MUNCUL
				$.each($datas.jobsubtypepaper, function($i, $jobpaper){
					if($jobpaper.paper.paperdetail.length == 0){
						console.log("#"+$jobpaper.id+" "+$jobpaper.paper.name+", was deleted");
						delete $datas.jobsubtypepaper[$i];
					}
				});
				$datas.jobsubtypepaper = $scope.filteremptyindex($datas.jobsubtypepaper);

				//SET DATA SIZE jadi NUMBER
				$.each($datas.jobsubtypesize, function($index, $item){
					$datas.jobsubtypesize[$index].size.width = parseFloat($item.size.width);
					$datas.jobsubtypesize[$index].size.length = parseFloat($item.size.length);
				});				

				//DIBUAT DEFAULT OF / DG
				if($datas.digitaloffset==0 || $datas.digitaloffset==1)
					$scope.selected.printtype = 'OF';
				else if($datas.digitaloffset==2)
					$scope.selected.printtype = 'DG';


				//CEK JOBSUBTYPEDETAIL
				if($datas.jobsubtypedetailshop!=null)
				{
					//berarti ada jobsubtypedetail
					$datas = $scope.changeDetailName($datas);
					//shop sudah ilang
				}

				$scope.setselecteddata($datas); //set data awal
				$scope.refreshOfDg();
				$scope.checkStandardSize();

				//DELETE NO USE DATA
				$scope.deleteUnused();
			}

			$scope.setFinishingData = function($datas){
				//buat tambahin option Tanpa Finishing, di zero index
				$.each($datas.jobsubtypefinishing, function($index, $item){
					$item = $scope.setFinishingZeroIndex($item, $item.finishing.name, $item.id);

					//set finishing name from finishing -> finishingoption (supaya kalo di select nanti ada nama finishingnya, di 'finishingname')
					$.each($item.finishing.finishingoption, function($j, $jj){
						$jj.finishingname = $item.finishing.name;
					});
				});

				//untuk set semuanya jadi Tanpa Finishing. DEFAULT
				$scope.selectFinishingZeroIndex($datas.jobsubtypefinishing);

				return $scope.clone($datas.jobsubtypefinishing);
			}

			//MASUKIN KE FUNCTION INI SATU PER SATU / FINISHING DATA
			$scope.setFinishingZeroIndex = function($item, $name, $id){
				var zero = {
					id: 0,
					optionname: 'Tanpa '+$name,
					processdays: 0,
					info: 'Tanpa '+$name,
					finishingID: $id
				};

				//Add data Tanpa Finishing
				$item.finishing.finishingoption.splice(0, 0, zero);

				return $item;
			}

			$scope.selectFinishingZeroIndex = function($jobsubtypefinishings){
				// $scope.selected <-- tampungannya
				// $scope.finishings <-- datanya
				$.each($jobsubtypefinishings, function($index, $item){
					if($item.finishing.finishingoption[0].id == '0')
					{
						//masukin ke selected sesuai index -> JANGAN CLONE!
						$scope.selected.finishings[$index] = $item.finishing.finishingoption[0];
					}

					//UNTUK PILIH SESUAI DEFAULT YANG DI MASUKIN DI DB
					$.each($item.finishing.finishingoption, function($j, $jj){
						if($jj.defaultoption == true){
							$scope.selected.finishings[$index] = $item.finishing.finishingoption[$j];
							
							//ganti finishing changed kalo ada default option (favourite)
							$scope.finishingchanged($item.finishing.name, $scope.selected.finishings[$index]);
						}
					});

				});
			}

			$scope.ofdgRemove = function($items, $key) {
				for ($i = $items.length - 1; $i >= 0; $i--) {
					if ($items[$i].ofdg == $key) {
						$items.splice($i, 1);
					}
				}
				return $items;
			};

			$scope.removeDetail = function($index){
				$scope.datas.jobsubtypedetail.splice($index, 1);
				$scope.selected.jobsubtypedetail.splice($index, 1);
			}

			$scope.addNewDetail = function(){
				//AMBIL INDEX TERAKHIR + 1
				$i = $scope.selected.jobsubtypedetail.length - 1 + 1;
				$obj = $scope.blankjobsubtypedetailselect;
				$detail = $scope.clone($scope.blankjobsubtypedetail);

				if($scope.selected.printtype=="OF")
				{
					$detail.jobsubtypedetailpaper = $scope.ofdgRemove($detail.jobsubtypedetailpaper, 2);
				}
				else if($scope.selected.printtype=="DG")
				{
					$detail.jobsubtypedetailpaper = $scope.ofdgRemove($detail.jobsubtypedetailpaper, 1);
				}

				//MASUKIN DULU DETAILNYA - SETELAH DI PILIHIN OF/DG
				$scope.datas.jobsubtypedetail.push($detail);

				//select index pertama
				if($detail.jobsubtypedetailpaper.length > 0)
					$obj.paper = $detail.jobsubtypedetailpaper[0].paper;

				$obj.finishing = [];
				$.each($detail.jobsubtypedetailfinishing, function($j, $jj){
					$jj = $scope.setFinishingZeroIndex($jj, $jj.finishing.name, $jj.id);

					$obj.finishing[$j] = $jj.finishing.finishingoption[0];
				});

				$scope.selected.jobsubtypedetail.push($obj);
			}

			$scope.splitMaster = function($datas, $type){
				//UNTUK BELAH MASTER JADI 'OF' DAN 'DG'
				$result = null;
				$result = $scope.clone($datas);

				if($result.jobsubtypedetail!=null)
				{
					$scope.selected.jobsubtypedetail = [];
					$.each($result.jobsubtypedetail, function($i, $ii){
						$obj = new Object();
						$obj.detailname = $ii.detailname;
						$obj.multip = $ii.defaultmultip;
						$obj.disabled = $ii.lockdetailmultip==1?true:false;
						$obj.max = $ii.maxmultip;
						$obj.min = $ii.minmultip;
						$obj.step = $ii.stepmultip;
						$obj.sideprint = $ii.sideprint==2?"2":"1";
						if($obj.detailname.length > 0)
							$obj.temporary = false;
						else
							$obj.temporary = true;
						
						if($obj.detailname.length > 0)
						{//KALO BUAT BLANKO, TIDAK DI SELECT DULU

							if($type=="OF")
							{
								$result.jobsubtypedetail[$i].jobsubtypedetailpaper = $scope.ofdgRemove($ii.jobsubtypedetailpaper, 2);
								$result.jobsubtypedetail[$i].jobsubtypedetailfinishing = $scope.ofdgRemove($ii.jobsubtypedetailfinishing, 2);
							}
							else if($type=="DG")
							{
								$result.jobsubtypedetail[$i].jobsubtypedetailpaper = $scope.ofdgRemove($ii.jobsubtypedetailpaper, 1);
								$result.jobsubtypedetail[$i].jobsubtypedetailfinishing = $scope.ofdgRemove($ii.jobsubtypedetailfinishing, 1);
							}

							//select index pertama
							if($ii.jobsubtypedetailpaper.length > 0)
								$obj.paper = $ii.jobsubtypedetailpaper[0].paper;

							$obj.finishing = [];
							$.each($ii.jobsubtypedetailfinishing, function($j, $jj){
								$jj = $scope.setFinishingZeroIndex($jj, $jj.finishing.name, $jj.id);

								$obj.finishing[$j] = $jj.finishing.finishingoption[0];
							});

							$scope.selected.jobsubtypedetail.push($obj);
						}
						else
						{
							//TAPI DATANYA DI SAVE
							$scope.blankjobsubtypedetailselect = $obj;
							$scope.blankjobsubtypedetail = $scope.clone($ii);

							delete $result.jobsubtypedetail.splice($i, 1);

							//ILANGIN 1 TERAKHIR YANG BLANKO
						}
					});
				}
				else
				{
					//kalo masi ada dari sebelomnya, di apus, biar ga bentrok di cek harga.
					if($scope.selected.jobsubtypedetail!=null)
						delete $scope.selected.jobsubtypedetail;
				}
				
				if($type=="OF"){
					$result.minqty = parseInt($result.minoffset);
					$result.maxqty = parseInt($result.maxoffset);
					$result.stepqty = parseInt($result.stepoffset);
					$result.defaultqty = parseInt($result.defaultoffset);

					//REMOVE 2 : DIGITAL <- PARAM ke-2
					$result.jobsubtypequantity = $scope.ofdgRemove($result.jobsubtypequantity, 2);
					$result.jobsubtypefinishing = $scope.ofdgRemove($result.jobsubtypefinishing, 2);
					$result.jobsubtypepaper = $scope.ofdgRemove($result.jobsubtypepaper, 2);
					$result.jobsubtypesize = $scope.ofdgRemove($result.jobsubtypesize, 2);
					$result.jobsubtypetemplate = $scope.ofdgRemove($result.jobsubtypetemplate, 2);

					$scope.selected.printerID = $result.printeroffset.id;
				}else if($type=="DG"){
					$result.minqty = parseInt($result.mindigital);
					$result.maxqty = parseInt($result.maxdigital);
					$result.stepqty = parseInt($result.stepdigital);
					$result.defaultqty = parseInt($result.defaultdigital);

					//REMOVE 1 : OFFSET <- PARAM ke-2
					$result.jobsubtypequantity = $scope.ofdgRemove($result.jobsubtypequantity, 1);
					$result.jobsubtypefinishing = $scope.ofdgRemove($result.jobsubtypefinishing, 1);
					$result.jobsubtypepaper = $scope.ofdgRemove($result.jobsubtypepaper, 1);
					$result.jobsubtypesize = $scope.ofdgRemove($result.jobsubtypesize, 1);
					$result.jobsubtypetemplate = $scope.ofdgRemove($result.jobsubtypetemplate, 1);

					$scope.selected.printerID = $result.printerdigital.id;
				}

				//SIZES & PAPERS tidak ada ofdg
				//$result.sizes = $scope.ofdgRemove($result.sizes, 1);
				//$result.papers = $scope.ofdgRemove($result.papers, 1);

				
				$.each($result.sizes, function($index, $item){
					$item.imagewidth = parseFloat($item.imagewidth);
					$item.imagelength = parseFloat($item.imagelength);
				});

				return $result;
			}

			$scope.setFinishingRole = function(){
				if($scope.selected.finishings!=null)
					if($scope.selected.finishings.length>0)
						$scope.selected.finishings = [];
				//BUAT APUS SEMUA FINISHING - REFRESH JADI 0 LAGI

				$scope.finishings = $scope.setFinishingData($scope.datas);
				//SET SEMUA FINISHING OPTION DI ENABLE
				$.each($scope.finishings, function($index, $item){
					$.each($item.finishing.finishingoption, function($index2, $item2){
						$scope.datas.jobsubtypefinishing[$index].finishing.finishingoption[$index2].disabled = false;
					});
				});

				$.each($scope.datas.jobsubtypefinishing, function($i, $ii) {
					if($ii.mustdo){
						$ii.finishing.finishingoption[0].disabled = true;
						//kalo lagi di select di option 0 baru boleh di ganti, kalo ga, ga boleh di ganti jadi option 1
						if($scope.selected.finishings[$i].id == 0){
							$scope.selected.finishings[$i] = $scope.finishings[$i].finishing.finishingoption[1];
							$scope.finishingchanged($scope.finishings[$i].finishing.name, $scope.selected.finishings[$i]); //check finishing change ketika ganti jadi option pertama
						}
					}
				});
			}

			$scope.refreshOfDg = function(){

				$finishchanging = false;

				$scope.datas = $scope.splitMaster($scope.master, $scope.selected.printtype);


				//SET DEFAULT
				if($scope.datas.jobsubtypepaper != null)
					if($scope.datas.jobsubtypepaper.length > 0)
						$scope.selected.paper = $scope.datas.jobsubtypepaper[0].paper;
				$scope.selected.quantity = $scope.datas.defaultqty;
				$scope.selected.sideprint = ($scope.datas.sisicetak=="2")?"2":"1";

				

				if($scope.selected.finishings!=null)
					if($scope.selected.finishings.length>0)
						$scope.selected.finishings = [];
				//BUAT APUS SEMUA FINISHING - REFRESH JADI 0 LAGI

				$scope.setFinishingRole();


				

				// 2 ==> CUMA CUSTOM AJA - BANNER!
				if($scope.datas.sizetype==2)
				{
					//buat flyer di  tambahin custom size di bawahnya
					$obj = $scope.setCustomSize();
					if($scope.datas.id==11||$scope.datas.id==12){
						//[11] outdoor
						//[12] indoor
						$obj.size.width = 100;
						$obj.size.length = 200;
					}
					$scope.selected.size = $obj.size;
					//langsung di custom size
				} // 0 ==> untuk Ubah Size (CUSTOM + INT) - FLYER KERTAS saja!
				else if($scope.datas.sizetype==0)
				{
					$obj = $scope.setCustomSize();
					//$scope.selected.size = $obj;
					$scope.selected.size = $scope.datas.jobsubtypesize[0].size;
				}
				// 1 ==> CUMA INT AJA, TIDAK BISA CUSTOM - AMPLOP

				//JIKA DATA BUKAN CUSTOM SIZE ONLY (2) <-- SIZE TYPE
				if($scope.datas.sizetype != 2)
					$scope.selected.size = $scope.datas.jobsubtypesize[0].size;	

				// SET AWAL UNTUK CHANGE OPTION
				if($scope.selected.size!=null)
					$scope.sizeChanged($scope.selected.size);
				if($scope.selected.paper!=null)
					$scope.matChanged($scope.selected.paper);

				//$scope.selectpickerrefresh($timeout);

				$finishchanging = true;
				$scope.getPrice();
			};

			$scope.checkStandardSize = function()
			{
				//buat cek ada template sizenya ga yang uda di sediain
				$scope.standardsize = false;
				$.each($scope.datas.jobsubtypesize, function($index, $item)
				{
					if($item.sizeID != 0){
						$scope.standardsize = true;
					}
				});

				if($scope.result.sizetype == 2)
				{ 
					// kalo 0 bisa fixed bisa custom
					// kalo 1 brarti ukuran FIXED
					// kalo 2 brarti ukuran CUMA ada CUstom
					$scope.standardsize = false;
				}
			}

			$scope.setCustomSize = function()
			{
				$size = new Object();
				$size.id=0;
				$size.width=10;
				$size.length=15;
				$size.name="Custom Size";
				$size.shortname='Custom';


				if($scope.datas.jobsubtypesize.length>0)
				{
					$size.width = $scope.datas.jobsubtypesize[0].size.width;
					$size.length = $scope.datas.jobsubtypesize[0].size.length;
				}

				$obj = new Object();
				$obj.id = 0;
				$obj.jobsubtypeID = $result.id;
				$obj.ofdg = 0;
				$obj.sizeID = 0;
				$obj.favourite = 0;
				$obj.size = $size;

				$result.jobsubtypesize.push($obj);

				return $obj;
			}

			$scope.increment = function($step){
				if(parseInt($scope.selected.quantity) + parseInt($step) <= $scope.datas['maxqty']){
					$scope.selected.quantity = parseInt($scope.selected.quantity) + parseInt($step);
					$scope.getPrice();
				}
			}
			$scope.decrement = function($step){
				if(parseInt($scope.selected.quantity) - parseInt($step) >= $scope.datas['minqty']){
					$scope.selected.quantity = parseInt($scope.selected.quantity) - parseInt($step);
					$scope.getPrice();
				}
			}
			$scope.incrementModel = function($index){
				if($scope.selected.jobsubtypedetail[$index].multip + $scope.selected.jobsubtypedetail[$index].step <= $scope.selected.jobsubtypedetail[$index].max)
				{
					$scope.selected.jobsubtypedetail[$index].multip += $scope.selected.jobsubtypedetail[$index].step;
					$scope.getPrice();
				}
			}
			$scope.decrementModel = function($index){
				if($scope.selected.jobsubtypedetail[$index].multip - $scope.selected.jobsubtypedetail[$index].step >= $scope.selected.jobsubtypedetail[$index].min)
				{
					$scope.selected.jobsubtypedetail[$index].multip -= $scope.selected.jobsubtypedetail[$index].step;
					$scope.getPrice();
				}
			}
			$scope.setQty = function($qty){
				$maxqty = $scope.datas['maxqty'];
				$minqty = $scope.datas['minqty'];
				if($qty <= $maxqty && $qty >= $minqty){
					$scope.selected.quantity = parseInt($qty);
					$scope.getPrice();
				}
			}
			$scope.setprinttype = function($printtype){
				if ($printtype != $scope.selected.printtype){
					$scope.selected.printtype = $printtype;
					$scope.refreshOfDg();
				}
			}
			$scope.getPrice = function(){
				if($finishchanging==true)
				{ //SUPAYA LOADNYA CUMA SEKALI STIAP GANTI


					$post = $scope.clone($scope.selected);
					$post.paperID = $scope.selected.paper.id;
					delete $post.paper;
					$post.deliveryID = $scope.selected.delivery.id;
					delete $post.delivery;
					delete $post.deliverylocked;
					delete $post.pagename;
					delete $post.jobsubtypelink;
					if(!$scope.customsize){
						$post.sizeID = $scope.selected.size.id;
						if ($post.sizeID != 0)
							delete $post.size;
					}else{
						$post.sizeID = 0;
						$post.size = $scope.selected.size;
						$post.size.name = "Custom Size";
					}
					$.each($post.finishings, function($i, $ii){
						if($ii.id==0)
							delete $post.finishings[$i];
						else{
							delete $ii.created_at;
							delete $ii.updated_at;
							delete $ii.info;
							$ii['optionID'] = $scope.selected.finishings[$i].id;
							delete $ii.id;
							delete $ii.optionname;
							delete $ii.processdays;
						}
					});


					$scope.counter++;
					$scope.waitingprice = true;
					$post.counter = $scope.counter;


					$http({
						"method" 	: "POST",
						"url" 		: AJAX_URL+"cekharga",
						"data"		: $post
					}).then(
						function(response){
							if (typeof response.data == "string") {
								if (response.data.length > 999) {
									//alert(response.data.length);
									$scope.error.savecartval = "Error - Menu '" + $scope.datas.name + "' belum bisa digunakan..";

								}else{
									$scope.error.savecartval = "Error: "+response.data;
								}
								$scope.total.price = 0;
								$scope.total.deliv = 0;
								$scope.total.disc = 0;
								$scope.total.price = 0;

								$scope.waitingprice = false; //bikin spinner stop
							} else {

								$scope.total = response.data.total;
								$scope.key = response.data.key;

								$scope.texttoread = response.data.texttoread;
								$scope.textcombination = response.data.textcombination;
								if (typeof $scope.total === 'undefined') {
									//KALO GA BISA DI ITUNG (GA MUNCUL TOTAL di indexnya)
									//MUNCULIN UNDER CONSTRUCTION
									$scope.waitingprice = false; //bikin spinner stop
									//$scope.underconstruction = true;
								}
								else {
									//KALO BELOM BISA KALKULASI TOTAL = ERROR (BELOM DI DEVELOP)
									if ($scope.isNum($scope.total.price))
										$scope.total.price = parseInt($scope.total.price);
									else $scope.total.price = 0;
									$.each($scope.finishings, function($index, $item) {
										if ($scope.isNum($item.totalprice)) {
											$item.totalprice = parseInt($item.totalprice);
											$scope.total.price += $item.totalprice;
										}
									});
									$scope.total.deliv = parseInt($scope.total.deliv);
									if ($scope.total.counter == $scope.counter)
										$scope.waitingprice = false;
								}

								$scope.checkerrorstatus();
							}
						},function(error){
							$scope.waitingprice = false; //bikin spinner stop
							$scope.total.price = 0;
							$scope.total.deliv = 0;
							$scope.total.disc = 0;
							$scope.total.price = 0;
							//$scope.underconstruction = true;

							$scope.error.savecartval = "Error - Menu '"+$scope.datas.name+"' belum bisa digunakan..";
						}
					);
				}
			}

			$scope.saveData = function(){
				if($scope.total.price==0)
					$scope.error.savebtnval = "Error - Menu '"+$scope.datas.name+"' belum bisa digunakan..";
				else if($scope.selected.jobtitle=="")
					$scope.error.savebtnval = "Belum ada judul cetakan!";
				else if($scope.selected.jobtitle.length < 8)
					$scope.error.savebtnval = "Judul Cetakan, kurang spesifik!";
				/*else if($scope.selected.files.length ==0)
					$scope.error.savebtnval = "File belum ada!";*/
				else if($scope.selected.cartID == null)
				{

					$http({
						"method" 	: "POST",
						"url"		: AJAX_URL + "shop/storecart",
						"data" 		: {
							"selected": $scope.selected,
							"key": $scope.key,
							"total": $scope.total
						}
					}).then(function(response){
						$scope.error.savebtnval = "";
						if(response.data != null){
							if(response.data.constructor === String)
							{
								if(response.data == "success")
									$window.location.href=BASE_URL+"cart";
							}
						}
						else
						{
							alert("Ada error dari server, untuk pemesanan bisa langsung WA / telp ke 0813 1551 9889");
						}
					});
				}else if($scope.selected.cartID != null){
					$http({
						"method" 	: "POST",
						"url"		: AJAX_URL + "shop/updatecart",
						"data" 		: {
							"selected": $scope.selected,
							"key": $scope.key,
							"total": $scope.total
						}
					}).then(function(response){
						$scope.error.savebtnval = "";
						if(response.data != null){
							if(response.data.constructor === String)
							{
								if(response.data == "success")
									$window.location.href=BASE_URL+"cart?c="+$scope.selected.cartID+"d=in";
							}
						}
						else
						{
							alert("Ada error dari server, untuk pemesanan bisa langsung WA / telp ke 0813 1551 9889");
						}
					});
				}
			}

			$scope.addresschanged = function(){
				if($scope.selected.deliveryaddress.id == 0){
					$scope.newaddress.name = "";
					$scope.newaddress.location = "";
					$scope.newaddress.note = "";
					if($scope.cities.length > 0){
						$scope.newaddress.city = $scope.cities[0];
						$.each($scope.cities, function($index, $item){
							if($item.name == "Jakarta"){
								$scope.newaddress.city = $scope.cities[$index];
							}
						});
					}
					//$scope.fillCities(); //pindah ke setiap pindah ke gojek
				}
			}

			$scope.changedelivery = function(delivery){
				$pickupadd = "----------"; 
				if(delivery.locked == 1)
				{
					$scope.selected.deliverylocked = true; //buat hide delivery detail
					$scope.selected.deliveryaddress = '';
				}
				else
				{
					$scope.selected.deliverylocked = false; // buat show delivery detail
					if($scope.selected.deliveryaddress != $pickupadd){
						if($scope.customeraddresses.length>1)
							//$scope.selected.deliveryaddress = $scope.customeraddresses[$scope.customeraddresses.length-1];
							$scope.selected.deliveryaddress = $scope.customeraddresses[0];
						else
							$scope.selected.deliveryaddress = '';

						if($scope.cities == null){
							$scope.fillCities();
						}else if($scope.cities.length > 0){
							$scope.fillCities();
						}
					}
				}
				//LEMPAR KE SERVER - DeliveryAPI
				/*$http({
					"method" 	: "POST",
					"url"			: API_URL + "deliveryprice",
					"data"		: {
						"data":delivery,
						"berat":$scope.result.total.weight
					}
				}).then(function(response){
					$scope.result.total.deliv = parseInt(response);
				}),function(error){
					console.log("change delivery error!")
				});*/

				$scope.getPrice();
			}

			$scope.showuploadfile = function(){
				$scope.renewuploadmodal();
				$("#uploadfileModal").modal('show');
			}

			$scope.showuploadurl = function(){
				$scope.renewuploadmodal();
				$("#uploadurlModal").modal('show');
			}

			$scope.checkuploadurl = function(){
				return ($scope.isURL($scope.uploadinputurl)||$scope.isURL("https://"+$scope.uploadinputurl));
			}

			$scope.saveuploadurl = function(){
				if($scope.isURL($scope.uploadinputurl)||$scope.isURL("https://"+$scope.uploadinputurl)){
					if($scope.uploadinputurl.indexOf("http")!=0){
						$scope.uploadinputurl = "https://"+$scope.uploadinputurl;
					}
					$scope.error.upload = "";


					$scope.saveuploadurltodb();


				}else{
					$scope.error.upload = "Your inputed URL is not valid. Please try to check and reinput the right one.";
				}

				// $scope.uploadinputurl2 = $scope.trustAsUrl($scope.uploadinputurl);
			}

			$scope.saveuploadurltodb = function(){
				$http({
					method: "POST",
					url: AJAX_URL+"files/saveurl",
					data: {
						url: $scope.uploadinputurl
					}
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								$scope.error.upload = "wrong response type, error in server";
								$scope.uploadsuccess = false;
							}else{
								$scope.uploadedfiles = response.data;
								$scope.uploadsuccess = true;
							}
						}else{
							$scope.error.upload = "URL cannot be process, something error";
							$scope.uploadsuccess = false;
						}
					}else{
						$scope.error.upload = "URL cannot be process, something error";
						$scope.uploadsuccess = false;
					}
				}, function(error){
					console.log(error);
					$scope.uploadsuccess = false;
				});
			}

			$scope.savefiledetail = function($id){
				if($scope.newfiledetail.length<=500){
					$http({
						method: "POST",
						url: AJAX_URL+"files/savedetail",
						data: {
							"detail": $scope.newfiledetail,
							"fileID": $id
						}
					}).then(function(response){
						if(response!=null){
							if(response.data != null){
								if(typeof response.data == "string"){
									$scope.error.upload = "Error - upload detail files";
								}else{
									$scope.uploadedfiles = response.data;
								}
							}else{
								$scope.error.upload = "Error - server ga bisa cari data file";
							}
						}
					}, function(error){
						$scope.error.upload = "Error - passing data not successful";
					});
				}else{
					$scope.error.upload = "Detail > 500 huruf (Prohibited)";
				}
			}

			$scope.showitemdescription = function(){
				$("#itemdescriptionModal").modal('show');
			}

			$scope.setselecteddata = function($datas){
				//DIJALANIN PAS REFRESH PAGE doang

				//DIBUAT STORE DATA YANG GA DI UBAH2 di $scope.master
				//CLONING
				$scope.master = $datas;

				$scope.selected.jobsubtypeID = $datas.id;
				$scope.selected.jobsubtypelink = $datas.link;
				$scope.selected.pagename = $datas.name;
				$scope.selected.satuan = $datas.satuan;

				$scope.deliveries = $datas.deliveries;
				$scope.setdelivery0();
			}

			$scope.setdelivery0 = function(){
				$scope.selected.delivery = $scope.deliveries[0];
				$scope.changedelivery($scope.deliveries[0]);
			}

			$scope.showsavedialog = function(){
				if($scope.role == "customer"){
					$scope.getPrice();
					$scope.setFinishingName();


					if($scope.checkerrorstatus())
						$('#savedialogModal').modal('show');

					//ERROR MERAH DI ATAS TOTAL HARGA
				}else{
					//alert('Anda harus LOG-IN untuk pesan!',  'JING');
					//alert($scope.alertmessagetitle);
					$scope.showAlertOK("Anda harus login untuk melakukan pemesanan", "You need to Log-IN to order..", true);
				}
			}

			$scope.checkerrorstatus = function(){
				if($scope.role == "customer"){
					//BILA SUDAH LOGIN BARU BISA DI CEK
					if($scope.total.price == 0)
						$scope.error.savecartval = "Error - Menu '"+$scope.datas.name+"' belum bisa digunakan..";
					else if($scope.selected.jobtitle=="")
						$scope.error.savecartval = "Belum ada judul cetakan!";
					else if($scope.selected.jobtitle.length < 8)
						$scope.error.savecartval = "Judul Cetakan, kurang spesifik!";
					/*else if($scope.selected.files.length == 0)
						$scope.error.savecartval = "File belum ada! Upload di tab 'File'";*/
					else if($scope.selected.deliveryaddress.length<10 && !$scope.selected.deliverylocked)
						$scope.error.savecartval = "Buat alamat pengiriman yang lengkap";
					else{
						$scope.error.savecartval = "";
						return true;
					}
				}else{
					//KALO BELOM LOGIN
					$scope.error.savecartval = "Anda harus LOG-IN untuk pesan";
				}

				return false;
			}

			$scope.showeasyaccess = function(){
				$('#easyaccess').modal('show');
			}

			$scope.sizeChanged = function($item)
			{
				if($item.id!=0)
				{
					if($item.id == 16)
					{
						// UKURAN 60x160 cm
						$scope.finOnly("standing banner", "60x160");
					}
					else if($item.id == 17)
					{
						// UKURAN 80x180 cm
						$scope.finOnly("standing banner", "80x180");
					}
					else if($item.id == 18)
					{
						// UKURAN 85x200
						$scope.finOnly("standing banner", "85x200");
					}

					//deprecated - harusnya ini function adalah efek dari change
					$scope.selected.size = $item;
					$scope.getPrice();
				}
				else
				{
					// KALO ID = 0 brarti custom
					$scope.customsize = true;
					$scope.selected.size = $item;
				}
			}

			$scope.showSize = function($id, $name, $width, $length){
				if($id != 0)
					return $name+" [ "+$width+" x "+$length+" cm ]";	
				else
					return $name;
			}

			$scope.changeToIntSize = function(){
				$scope.customsize = false;
				//$scope.selectpickerrefresh($timeout);
				$scope.selected.size = ($scope.datas.jobsubtypesize[0].size);
			}

			$scope.matChanged = function($item, $finishingfield)
			{

				if ($item.papertypeID == 1 || $item.papertypeID == 2)
				{
					//KONDISI KETIKA MATERIAL ARTPAPER / ARTCARTON

					// LAMINATING
					if ($item.gramature < 150) $scope.finStat('laminasi', false, $finishingfield);
					else $scope.finStat('laminasi', true, $finishingfield);

					//VARNISH
					if ($item.gramature < 120) $scope.finStat('varnish', false, $finishingfield);
					else $scope.finStat('varnish', true, $finishingfield);
				}
				else if ($item.papertypeID == 9) 
				{
					// KONDISI UNTUK BAHAN INDOOR
					if($item.paperID == 28)
						$scope.finStat('laminasi', true, $finishingfield);
					else
						$scope.finStat('laminasi', false, $finishingfield);
				}
				else if ($item.papertypeID == 7)
				{
					//KONDISI UNTUK BAHAN OUTDOOR
					$scope.finStat('laminasi', false, $finishingfield);
			}
				else if ($item.papertypeID == 10)
				{
					// KALO STICKER --> JADI 1 mUKA
					$scope.selected.sideprint = "1";
				}
				else
				{
					$scope.finStat('laminasi', false, $finishingfield);
					$scope.finStat('varnish', false, $finishingfield);
				}

				if ($item.gramature > 170)
					$scope.finStat('lipat', false, $finishingfield);
				else
					$scope.finStat('lipat', true, $finishingfield);

				if ($item.gramature < 80)
					$scope.finStat('perforasi', false, $finishingfield);
				else
					$scope.finStat('perforasi', true, $finishingfield);


				//DOUBLE SIDE DI SIMPEN DI PAPER-printbothside
				if($scope.selected.paper.bothsideprint==2){
					$scope.datas.sisicetak = 2; //harus 2
					$scope.selected.sideprint = "2";
					$scope.materialvariable = "Akan dicetak pada kedua sisi / bolak balik.";
					//2 sisi
				}else if($scope.selected.paper.bothsideprint==1){
					$scope.datas.sisicetak = 1; //hrus 1
					$scope.selected.sideprint = "1";
					$scope.materialvariable = "Bahan ini hanya dapat dicetak pada 1 sisi.";
					//1 sisi
				}else if($scope.selected.paper.bothsideprint==0){
					$scope.datas.sisicetak = 0;
					$scope.materialvariable = "";
					//$scope.selected.sideprint = "1";
					//bebas
				}


				$scope.getPrice();
			}

			$scope.showMaterialName = function ($name, $gramature)
			{
				if($gramature!=0)
					$result = $name+" "+$gramature+" gsm";
				else
					$result = $name;
				return $result;
			}

			$scope.finishingchanged = function($name, $selected, $finishingfield=null){
				/*if($finishingfield != null)
					console.log($finishingfield);*/
				if ($name == "Laminasi")
				{
					if($selected.id > 0)
						$scope.finSelect('varnish', 0, $finishingfield);

					if ($selected.optionname.toLowerCase().indexOf("matte") != -1)
						$scope.finStat('spot varnish', true, $finishingfield); //SPOT UV
					else if ($selected.optionname.toLowerCase().indexOf("gloss") != -1)
						$scope.finStat('spot varnish', false, $finishingfield); //SPOT UV
				}
				else if ($name == "Varnish")
				{
					if($selected.id > 0)
					{
						$scope.finStat('spot varnish', false, $finishingfield); //SPOT UV
						$scope.finSelect('laminasi', 0, $finishingfield); //LAMINATING DIBUAT JADI TANPA LAMINATING
					} 
					else
						$scope.finStat('spot varnish', true, $finishingfield);
				}else if ($name == "Cutting"){
					if($selected.optionname.toLowerCase().indexOf("die cut") != -1){
						$selected.warningmessage = "Untuk potongan Die Cut, harap cantumkan keterangan potong pada file. Harga diatas (belum fix) akan disesuaikan setelah data kami terima, dan akan diberitahukan melalui telepon.";
					}
				} else if ($name == "Standing") {
					if ($selected.optionname.toLowerCase().indexOf("x banner") != -1) {
						$selected.warningmessage = "Agar lebih kuat, silahkan buat design dengan ukuran 60x155 cm, agar kokoh pada tiang penyangga.";
					}
				}

				$scope.getPrice();
			}

			$scope.selectFinIndex = function($text, $finishingfield)
			{
				$index = -1;
				$.each($finishingfield, function($i, $item) {
					if($item.finishing.name.toLowerCase() == $text)
					{
						$index = $i;
					}
				});
				return $index;
			}

			$scope.finSelect = function($text, $select, $finishingfield)
			{
				$index = $scope.selectFinIndex($text, $finishingfield);
				if($index == -1) return 0;
				if($scope.finishings[$index].finishing.finishingoption.length > $select)
				{ //KALAU LEBIH KECIL DARI LEBGTH
					if($select >= 0)
					{
						$scope.selected.finishings[$index] = $scope.finishings[$index].finishing.finishingoption[$select];
					}
				}
			}

			$scope.finOnly = function($text, $keyoptions, $finishingfield)
			{
				$index = $scope.selectFinIndex($text, $finishingfield);
				if ($index == -1) return 0;
					for($i = 1; $i < $scope.finishings[$index].finishing.finishingoption.length; $i++)
					{
						//YANG TIDAK ADA KEYWORD $keyoptions <-- DI DISABLE
						//console.log($scope.datas.finishings[$index].options[$i].optionname + " --> " + $scope.datas.finishings[$index].options[$i].optionname.indexOf($keyoptions));
						if($scope.finishings[$index].finishing.finishingoption[$i].optionname.indexOf($keyoptions) != -1)
							$scope.finishings[$index].finishing.finishingoption[$i].disabled = false;
						else
							$scope.finishings[$index].finishing.finishingoption[$i].disabled = true;
					}
				for($i = 1; $i < $scope.finishings[$index].finishing.finishingoption.length; $i++)
				{
					if(!$scope.finishings[$index].finishing.finishingoption[$i].disabled)
					{
						$scope.selected.finishings[$index] = $scope.finishings[$index].finishing.finishingoption[$i];
					}
				}
			}

			$scope.finStat = function($text, $enable, $finishingfield) {
				$index = $scope.selectFinIndex($text, $finishingfield);
				if ($index == -1) return 0;
				if($scope.finishings[$index].finishing.finishingoption.length > 1)
					for($i = 1; $i < $scope.finishings[$index].finishing.finishingoption.length; $i++)
					{
						//console.log($scope.selected.jobsubtypefinishing[7]);
						//console.log($scope.finishings[7].finishing.finishingoption[$i]);
						if($scope.finishings[$index].finishing.finishingoption[$i].optionID == $scope.selected.finishings[$index].optionID)
							$scope.selected.finishings[$index] = $scope.finishings[$index].finishing.finishingoption[0];
						$scope.finishings[$index].finishing.finishingoption[$i].disabled = !$enable;
					}
			}

			$scope.finStat0 = function($text, $enable, $finishingfield) {
				$index = $scope.selectFinIndex($text, $finishingfield);
				if ($index == -1) return 0;
				else {
					if($scope.finishings[$index].finishing.finishingoption.length > 1){
						$scope.finishings[$index].finishing.finishingoption[0].disabled = !$enable;
						$scope.selected.finishings[$index] = $scope.finishings[$index].finishing.finishingoption[1];
					}
				}
			}

			$scope.setFinishingName = function($id){
				$.each($scope.finishings, function($i, $ii){
					$.each($scope.selected.finishings, function($j, $jj){
						if($ii.id == $jj.finishingID && $jj != 0)
						{
							$jj.finishingname = $ii.finishing.name;
						}
					});
				});
			}

			$scope.addnewaddress = function($custid){
				console.log($custid);
				if(!$scope.waitingaddnewadds){
					$scope.waitingaddnewadds = true;
					$scope.errornewaddress = false;
					if($custid != null){
						$http({
							method: "POST",
							url: AJAX_URL+"custadds/store/"+$custid,
							data: $scope.newaddress
						}).then(function(response){
							if(response.data != null){
								if(response.data.constructor === Array){
									$scope.customeraddresses = response.data;
									$scope.selected.deliveryaddress = $scope.customeraddresses[$scope.customeraddresses.length-1];
									$scope.addtambahbaruaddress();
									$scope.errornewaddress = false;
								}else{
									$scope.errornewaddress = true;
								}
							}else{
								$scope.errornewaddress = true;
							}
							$scope.waitingaddnewadds = false;
						}, function(error){
							$scope.errornewaddress = true;
							$scope.waitingaddnewadds = false;
						});
					}
				}
			}

			$scope.removeSelectedFiles = function($file)
			{
				if($scope.loadingfiles==false)
				{
					$scope.loadingfiles = true;
					//REMOVE DI SERVER
					$http({
						"method"	: "POST",
						"url"			: API_URL+"upload/delete",
						"data"		: $file['id']
					}).then(
						function(response){
							if(response!=null)
							{
								if(response.data.constructor === Array)
								{
									$scope.uploadedfiles = response.data;
									if ($scope.uploadedfiles.length > 0) 
										$scope.tableshow = true;
								}
								else
								{
									$scope.uploadedfiles = [];
								}
							}
							else
							{
								$scope.tableshow = false;
								$scope.uploadedfiles = [];
							}
							$scope.loadingfiles = false;
							$scope.allowed();
						},function(error){
							if(code==403)
							{
								$scope.restrictNotLogined();
							}
						}
					);
				}
			}

			$scope.checkSelectedFiles = function(){
				$scope.selected.files = [];
				$.each($scope.uploadedfiles, function($index, $item){
					if($item.checked){
						$scope.selected.files.push($item);
					}
				});
			}

			$scope.refreshUploadedImage = function(){
				if(!$scope.loadingfiles)
				{
					$scope.loadingfiles = true;
					$http({
						"method"	: "GET",
						"url"			: API_URL+"pendimg"
					}).then(
						function(response){

							if(response.data!=null)
							{
								if(response.data.constructor === Array)
								{
									$scope.uploadedfiles = response.data;
									if ($scope.uploadedfiles.length > 0) {
										$scope.tableshow = true;
										$filclone = $scope.clone($scope.selected.files);
										$scope.selected.files = [];
										//abis di hapus jangan lupa masukin ke selected.fileslagi
										$.each($scope.uploadedfiles, function($i, $ii) {
											//$ss <- from searched url
											$.each($filclone, function($s, $ss) {
												//auto select kalo di temukan
												//buat jadi $ii.checked
												if ($ii.id == $ss.fileID) {
													$ii.checked = true;
													$scope.selected.files.push($ii);
													//$scope.checkSelectedFiles($ii);
												}
											})
										});
									}
									$scope.allowed();
								}
								else
								{
									$scope.uploadedfiles = [];
								}
							}
							else
							{
								$scope.uploadedfiles = [];
							}
							$scope.loadingfiles = false;
						},function(error){
							$scope.uploadedfiles = [];
							if(error.code==403)
							{
								$scope.restrictNotLogined();
							}
					
							$scope.loadingfiles = false;
						}
					);
				}
			}

			$scope.showcombinations = function(){
				$('#combinations').modal('show');
			}

			$scope.saveTexttoread = function(){
				if($scope.texttoread != null){
					if($scope.texttoread.length > 1){
						//UPLOAD

						if($scope.role == null){
							$custID = null;
							$empID = null;
						}else{
							if($scope.role == "employee"){
								$custID = null;
								$empID = $scope.userid;
							}else{
								$custID = $scope.userid;
								$empID = null;
							}
						}

						$data = {
							'pricetext': $scope.texttoread,
							'customerID': $custID,
							'employeeID': $empID,
							'jobsubtypeID': $scope.selected.jobsubtypeID,
							'totalprice': $scope.total.price
						};
						
						$http({
							method: "POST",
							url: API_URL+"pricetext/save",
							data: $data
						}).then(function(response){
							if(response.data != null){
								if(typeof response.data == "string"){
									if(response.data == "success"){
										$scope.savepricetextresult = response.data;
									}
								}
							}else{
								alert('error saving');
							}
						});
						
					}
					else{
						console.log("Text to read length < 1");
					}
				}else{
					console.log("Text to read null");
				}
			}

			$scope.selecttemplate = function(item){
				$finishchanging = false;
				//SELECT SIZE
				$.each($scope.datas.jobsubtypesize, function($i, $ii){
					if($ii.size.id == item.size.id){
						$ii.size.length = parseInt($ii.size.length);
						$ii.size.width = parseInt($ii.size.width);
						//harusnya di sini ada $scope.selected.size = $ii.size;
						$scope.sizeChanged($ii.size);
					}
				});
				//SELECT PAPER
				$.each($scope.datas.jobsubtypepaper, function($i, $ii){
					if($ii.paper.id == item.paper.id){
						$scope.selected.paper = $ii.paper;
						$scope.matChanged($ii.paper);
					}
				});
				$scope.selected.sideprint = item.sideprint+"";
				//SELECT FINISHING OPTIONS
				$.each($scope.datas.jobsubtypefinishing, function($i, $ii){
					$.each(item.jobsubtypetemplatefinishing, function($j, $jj){
						if($ii.finishing.id == $jj.finishingID){
							//ketemu finishingnya
							$scope.selected.finishings[$i] = $jj.finishingoption;
							$scope.finishingchanged();
						}
					});
				});
				$("#input-jobtitle").focus();
				$finishchanging = true;
				$scope.getPrice();
			}

			var upload = function(files) {
				var data = new FormData();
				$scope.error.upload = '';
				$scope.uploadwaiting = true;
				$scope.loadingfiles = true;

				$counterror = 0;
				$scope.$apply(function(){});

				angular.forEach(files, function(value){
					$ext = value.name.substring(value.name.lastIndexOf('.') + 1);

					if ($ext != 'cdr' &&
						$ext != 'zip' &&
						$ext != 'rar' &&
						$ext != 'ai' &&
						$ext != 'xls' &&
						$ext != 'xlsx' &&
						$ext != 'doc' &&
						$ext != 'docx' &&
						$ext != 'tiff' &&
						$ext != 'tif' &&
						$ext != 'pdf' &&
						$ext != 'jpg' &&
						$ext != 'jpeg' &&
						$ext != 'psd' &&
						$ext != '7z' &&
						$ext != 'txt' &&
						$ext != 'indd') //indesign
					{
						//FORMAT NGACOK
						$scope.error.upload = value.name+" : tidak bisa upload dengan file format "+$ext+".";
						$counterror++;
					}
					else if(value.size > 50 * 1024 * 1024)
					{
						$scope.error.upload = value.name+" : file terlalu besar.";
						$counterror++;

					}
					else 
					{
						$scope.error.upload = "";
						data.append("files[]", value);
					}

					if($scope.error.upload!=''){

						//BUANGAN SUPAYA BISA LOAD HTML DOANG (GA TAU KNPAA)
						try{
							$http({
								method: 'POST',
								url: BASE_URL,
								data: data,
								withCredentials: true,
								headers: {'Content-Type': undefined },
								transformRequest: angular.identity
							}).then(function(response){},
							function(error){
								console.log(error);
							});
						}catch(error){}


						//refesh data kalo ga bisa ke upload (loading filesnya jangan di apus)
						$scope.loadingfiles = false;
						$scope.uploadwaiting = false;
						$scope.refreshUploadedImage();
						//$scope.uploadwaiting = false;
						return null;
					}
					
					//UPLOAD FILE DATA
					$scope.uploadpost(data);
				});

				//JANGAN DI BUANG, harusnya di pake
				//$scope.clearFileInput('file');
			};

			$(function () {
				var token = $('input[name="_token"]').val();
				$(document).ajaxSend(function(e, xhr, options) {
					//console.log("ajax token!!!");
					xhr.setRequestHeader('X-CSRF-Token', token);
				});
			});

			$scope.uploadpost = function(data){
				$.ajax({
					// Your server script to process the upload
					url: API_URL+'upload',
					type: 'POST',

					// Form data
					data: data,

					// Tell jQuery not to process data or worry about content-type
					// You *must* include these options!
					cache: false,
					contentType: false,
					processData: false,
					withCredentials: true,
					headers: {'Content-Type': undefined },
					//headers: {"X-CSRF-Token":token},
					transformRequest: angular.identity,

					// Custom XMLHttpRequest
					xhr: function() {
						var myXhr = $.ajaxSettings.xhr();
						if (myXhr.upload) {
							// For handling the progress of the upload
							myXhr.upload.addEventListener('progress', function(e) {
									if (e.lengthComputable) {
										$('.progress-bar').css('width', (e.loaded/e.total*100)+"%");
										var value = e.loaded/e.total*100;
									}
								}
							, false);

							myXhr.upload.addEventListener('loadend', function(e) {
									$scope.filesize = e.total;
									$scope.loadingfiles = false;
									$scope.uploadwaiting = false;
									$scope.allowed();

								}
							, false);

							
						}
						return myXhr;
					}
				}).done(function(response){
					$jumlahsebelomupload = -1;
					if(response!=null)
					{
						if(response.constructor === Array)
						{
							$jumlahsebelomupload = $scope.uploadedfiles.length;
							$scope.uploadedfiles = [];
							$scope.uploadedfiles = response;
							if ($scope.uploadedfiles.length > 0) 
								$scope.tableshow = true;

							if($jumlahsebelomupload < $scope.uploadedfiles.length){
								$scope.uploadsuccess = true;
								$scope.error.upload = "";
							}else{
								$scope.error.upload = "Tidak berhasil ditambahkan";
							}

							//UNTUK REFRESH YANG ADA DI ANGULAR HTML
							$scope.$apply(function(){});
						}
						else if(response.constructor === String){
							$scope.error.upload = response.constructor;
							$scope.uploadedfiles = [];
						}
						else
						{
							$scope.error.upload = "Error, tidak dapat terima data yang sudah di upload (empty).";
							$scope.uploadedfiles = [];
						}
					}
					else
					{
						$scope.error.upload = "Error, tidak dapat terima data yang sudah di upload (null).";
						$scope.uploadedfiles = [];
						//console.log	('NO DATA in PendIMG');
					}
					$scope.loadingfiles = false;
					$scope.uploadwaiting = false;
					$scope.allowed();

					$scope.$apply(function(){});
				}).fail(function(response){
					if(response.status == 419){
						$scope.error.upload = "Session is over, please re-login to upload";
					}else{
						$scope.error.upload = response.statusText;
					}
					$scope.loadingfiles = false;
					$scope.uploadwaiting = false;
					$scope.uploadsuccess = false;;


					$scope.$apply(function(){});
				});
			}

			$scope.renewuploadmodal = function(){
				$scope.refreshUploadedImage();
				$scope.error.upload = '';
				$scope.uploadsuccess = false;
			}

			$scope.getMaxFilesize = function(){
				$http({
					method: "GET",
					url: API_URL+"file/maxfilesize"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								$scope.uploadmaxfilesize = response.data;
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.clearFileInput = function(id) 
			{ 
				var oldInput = document.getElementById(id); 

				var newInput = document.createElement("input"); 

				newInput.type = "file"; 
				newInput.id = oldInput.id; 
				newInput.name = oldInput.name; 
				newInput.className = oldInput.className; 
				newInput.style.cssText = oldInput.style.cssText; 
				// TODO: copy any other relevant attributes 

				oldInput.parentNode.replaceChild(newInput, oldInput); 
			}

			$scope.descheadtabclick = function(){
				var body = $("html, body");
				var top = $("#desc-headtab").offset().top-10;
				body.stop().animate({scrollTop:top}, 500, 'swing', function() { 
					$("#desc-headtab").tab('show');
				});
			}

			$scope.cetakpenawaran = function(){
				$("#offerintext").modal("show");
			}

			$scope.calcheadtabclick = function(){
				var body = $("html, body");
				var top = $("#calc-headtab").offset().top-10;
				body.stop().animate({scrollTop:top}, 500, 'swing', function() { 
					$("#calc-headtab").tab('show');
				});
			}

			$scope.fileis = function(){
				if($scope.uploadedfiles != null){
					if($scope.uploadedfiles.length>0){
						$ext = $scope.uploadedfiles[$scope.uploadedfiles.length-1].path.substring($scope.uploadedfiles[$scope.uploadedfiles.length-1].path.lastIndexOf('.')+1);
						if($ext == "zip" || $ext == "rar"){
							return "pdf";
						}
					}else{
						return "-";
					}
				}else{
					return "";
				}
			}

			$scope.choosefileclicked = function(){
				$('#btn-choose-file').click();
			}

			$('#real-dropzonew').on('change', function(e) { 
				e.preventDefault();
				e.stopPropagation();
				if ($(this)[0]['file'].files){
					if ($(this)[0]['file'].files.length > 0) {
						upload($(this)[0]['file'].files);
					}
				} 
				return false;
			});

			$scope.showpickup = function(){
				$("#showpickup").modal('show');
			}
		}
	]);
};