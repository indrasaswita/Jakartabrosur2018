module.exports = function(app){
	app.controller('CreateOrderController', ['$timeout', '$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($timeout, $scope, $http, API_URL, BASE_URL, $window){

			//INIT DATA SELECTED
			$scope.selected = {
				'paper': 0,
				//'quantity': 500,
				'size' : 0,
				'printtype' : 'DG',
				'sideprint' : 1,
				'processtime' : 'std',
				'reseller' : 'std',
				'perbungkus' : "1000",
				'imagewidth' : '21',
				'imagelength' : '29.7',
				'jobsubtypeID' : -1,
				'jobtitle' : 'Test 1 2 3 4 5 6 6 7777...',
				'customernote' : '',
				'itemdescription' : '',
				'customernote' : '',
				'resellerphone' : '',
				'resellername' : '',
				'reselleraddress' : '',
				'files' : [],
				'finishings' : []
			};
			
			$finishchanging = false;
			$scope.counter = 0;
			$scope.underconstruction = false;
			$scope.uploaderror = "";
			$scope.uploadwaiting = false;
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
			
			$scope.uploadedfiles = [];
			$scope.error = {
				"files" : "",
				"savecart" : "",
				"savecartval" : "",
				'savebtnval' : "",
				"description" : "",
			};
			$scope.total = [];

			$scope.setUserLogin = function($role)
			{
				if($role==null){
					$scope.restrictNotLogined();
				}else if($role!='customer'){
					$scope.restrictNotCustomer();
				}else
				{
					$scope.allowed();
				}
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
				$.each($datas.jobsubtypedetailshop, function($index, $item){
					$datas.jobsubtypedetail[$index] = $scope.changeFinishingDetailName($item);
					$datas.jobsubtypedetail[$index] = $scope.changePaperDetailName($item);
				});
					

				delete $datas.jobsubtypedetailshop;

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

			$scope.setData = function($jobsubtypes){
				$scope.jobsubtypes = $jobsubtypes;
			}

			$scope.getTemplate = function($link){
				$http({
					method: "GET",
					url 	: API_URL+"jobsubtype/"+$link
				}).then(function(response){
					$scope.template = response.data;
					console.log($scope.template);
				});
			}

			$scope.setFinishingData = function($datas){
				//buat tambahin option Tanpa Finishing, di zero index
				$.each($datas.jobsubtypefinishing, function($index, $item){
					$item = $scope.setFinishingZeroIndex($item, $item.finishing.name, $item.id);
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

			$scope.refreshOfDg = function(){

				$finishchanging = false;

				$scope.datas = $scope.splitMaster($scope.master, $scope.selected.printtype);


				//SET DEFAULT
				if($scope.datas.jobsubtypepaper != null)
					if($scope.datas.jobsubtypepaper.length > 0)
						$scope.selected.paper = $scope.datas.jobsubtypepaper[0].paper;
				$scope.selected.quantity = $scope.datas.defaultqty;
				$scope.selected.sideprint = ($scope.datas.sisicetak=="2")?"2":"1";

				//$scope.selected.jobsubtypefinishings = [];
				//TAMBAHIN DATA No Finishing Di paling atas
				/* $.each($scope.datas.jobsubtypefinishing, function($index, $item){
					$zero = {
						"finishingID":$item.finishing.id,
						"id":0,
						"optionname":"Tanpa "+$item.finishing.name,
						"price":0,
						"priceper":"pcs",
						"priceminim":0,
						"pricebase":0,	
						"processday": 0,
						"info": 'Tanpa '+$item.finishing.name
					};
					//masukin data di atas ke index option 0
					$scope.datas.jobsubtypefinishing[$index].finishing.finishingoption.splice(0, 0, $zero);
					//BUAT DEFAULT SELECTED - JADI No Finishing
					$scope.selected.finishings.push($item.finishing.finishingoption[0]);
				}); */

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

				//UNTUK KONDISI YANG BERUBAH KETIKA DIUBAH OFFSET DIGITAL-NYA
				// if($scope.selected.pagename.toLowerCase() == "flyer"
				// 	&& $scope.selected.printtype.toUpperCase() == 'OF')
				// {
					
				// }

				// buat flyer selalu select potong - OF Only
				// dan disable index ke 0
				if($scope.selected.jobsubtypeID == 1) { 
					//FLYER untuk ID jobsubtype = 1
					if($scope.selected.printtype == "OF"){
						$scope.finStat0("potong", false);
					}else if($scope.selected.printtype == "DG"){
						$scope.finStat0("potong", true);
					}
				}

				// 2 ==> CUMA CUSTOM AJA - BANNER!
				if($scope.datas.sizetype==2)
				{
					//buat flyer di  tambahin custom size di bawahnya
					$obj = $scope.setCustomSize();
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

				$scope.selectpickerrefresh($timeout);

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
				if($scope.selected.quantity + $step <= $scope.datas['maxqty']){
					$scope.selected.quantity += $step;
					$scope.getPrice();
				}
			}
			$scope.decrement = function($step){
				if($scope.selected.quantity - $step >= $scope.datas['minqty']){
					$scope.selected.quantity -= $step;
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
				//console.log($scope.selected);

				if($finishchanging==true)
				{ //SUPAYA LOADNYA CUMA SEKALI STIAP GANTI
					$scope.counter++;
					$scope.waitingprice = true;
					$scope.selected.counter = $scope.counter;


					$http({
						"method" 	: "POST",
						"url" 		: API_URL+"cekharga",
						"data"		: $scope.selected,
					}).then(
						function(response){

							$scope.total = response.data.total;
							$scope.key = response.data.key;
							if(typeof $scope.total ==='undefined')
							{
								//KALO GA BISA DI ITUNG (GA MUNCUL TOTAL di indexnya)
								//MUNCULIN UNDER CONSTRUCTION
								$scope.waitingprice = false; //bikin spinner stop
								//$scope.underconstruction = true;
							}
							else
							{
								//KALO BELOM BISA KALKULASI TOTAL = ERROR (BELOM DI DEVELOP)
								if($scope.isNum($scope.total.price))
									$scope.total.price = parseInt($scope.total.price);
								else $scope.total.price = 0;
								$.each($scope.finishings, function($index, $item){
									if($scope.isNum($item.totalprice))
									{
										$item.totalprice = parseInt($item.totalprice);
										$scope.total.price += $item.totalprice;
									}
								});
								$scope.total.deliv = parseInt($scope.total.deliv);
								if($scope.total.counter == $scope.counter)
									$scope.waitingprice = false;
							}

							$scope.checkerrorstatus();
						},function(error){
							//console.log("masuk ke ERROR");
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
				else if($scope.selected.files.length ==0)
					$scope.error.savebtnval = "File belum ada!";
				else
				{
					$http({
						"method" 	: "POST",
						"url"			: API_URL + "storecartdetail",
						"data" 		: {
							"selected": $scope.selected,
							"calculation": $scope.key,
							"total": $scope.total
						}
					}).then(function(response){
						$scope.error.savebtnval = "";
						if(response.data.constructor === String)
						{
							$window.location.href=BASE_URL+"cart";
						}
					});
				}
			}

			$scope.changedelivery = function(delivery){
				$pickupadd = "----------"; 
				if(delivery.locked == 1)
				{
					$scope.selected.deliverylocked = true;
					$scope.selected.deliveryaddress = $pickupadd;
				}
				else
				{
					$scope.selected.deliverylocked = false;
					if($scope.selected.deliveryaddress == $pickupadd)
						$scope.selected.deliveryaddress = "";
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
				$scope.refreshUploadedImage();
				$scope.uploaderror = '';
				$("#uploadfileModal").modal('show');
			}

			$scope.showitemdescription = function(){
				$("#itemdescriptionModal").modal('show');
			}

			$scope.setdelivery0 = function(){
				$scope.selected.delivery = $scope.deliveries[0];
				$scope.changedelivery($scope.deliveries[0]);
			}

			$scope.showsavedialog = function(){
				$scope.getPrice();
				$scope.setFinishingName();

				if($scope.checkerrorstatus())
					$('#savedialogModal').modal('show');

				//ERROR MERAH DI ATAS TOTAL HARGA
			}

			$scope.checkerrorstatus = function(){
				if($scope.total.price == 0)
					$scope.error.savecartval = "Error - Menu '"+$scope.datas.name+"' belum bisa digunakan..";
				else if($scope.selected.jobtitle=="")
					$scope.error.savecartval = "Belum ada judul cetakan!";
				else if($scope.selected.jobtitle.length < 8)
					$scope.error.savecartval = "Judul Cetakan, kurang spesifik!";
				else if($scope.selected.files.length == 0)
					$scope.error.savecartval = "File belum ada!";
				else if($scope.selected.deliveryaddress.length<10)
					$scope.error.savecartval = "Buat alamat pengiriman yang lengkap";
				else{
					$scope.error.savecartval = "";
					return true;
				}

				return false;
			}

			$scope.showeasyaccess = function(){
				$('#easyaccess').modal('show');
			}

			$scope.showdelivery = function(){
				//AMBIL DATA DARI DATABASE
				$http({
					"method" 	: "POST",
					"url"			: API_URL + "delivery"
				}).then(
					function(response){
						if(response != null)
						{
							if(response.data.length > 0)
							{
								$('#deliveryModal').modal('show');	
								$scope.deliveries = response.data;
								if($scope.selected.delivery != null)
								{
									$adadioption = false;
									$.each($scope.deliveries, function($index, $item){
										if($item.id == $scope.selected.delivery.id)
										{
											$adadioption = true;
											$scope.selected.delivery = $item; // <-- BUG
											// HARUS DI SET ULANG
											// KALO GA DIA GA MAU KE SET, KETIKA KEBUKA KEDUA
										}
									});
									if($adadioption == false){
										$scope.selected.delivery = response[0];
									}
								}
							}
						}
						else
						{
							$scope.selectpickerrefresh($timeout);
							$scope.selected.delivery = response[0];	
						}
						//KALO BISA BARU DI SHOW	
						$scope.changedelivery($scope.selected.delivery);
						//KALO UDA DI SHOW, HARUS DI REFRESH DATANYA		
					},function(error){
						console.log("ERROR, GA BISA BACA DATA DARI DELIVERIES");
					}
				);
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
				$scope.selectpickerrefresh($timeout);
				$scope.selected.size = ($scope.datas.jobsubtypesize[0].size);
			}

			$scope.matChanged = function($item)
			{
				if ($item.papertypeID == 1 || $item.papertypeID == 2)
				{
					//KONDISI KETIKA MATERIAL ARTPAPER / ARTCARTON

					// LAMINATING
					if($item.gramature < 150) $scope.finStat('laminasi', false);
					else $scope.finStat('laminasi', true);

					//VARNISH
					if($item.gramature < 120) $scope.finStat('varnish', false);
					else $scope.finStat('varnish', true);
				}
				else if ($item.papertypeID == 9) 
				{
					// KONDISI UNTUK BAHAN INDOOR
					if($item.paperID == 28)
						$scope.finStat('laminasi', true);
					else
						$scope.finStat('laminasi', false);
				}
				else if ($item.papertypeID == 7)
				{
					//KONDISI UNTUK BAHAN OUTDOOR
					$scope.finStat('laminasi', false);
				}
				else if ($item.papertypeID == 10)
				{
					// KALO STICKER --> JADI 1 mUKA
					$scope.selected.sideprint = "1";
				}
				else
				{
					$scope.finStat('laminasi', false);
					$scope.finStat('varnish', false);
				}

				if ($item.gramature > 170)
					$scope.finStat('lipat', false);
				else
					$scope.finStat('lipat', true);

				if ($item.gramature < 80)
					$scope.finStat('perforasi', false);
				else
					$scope.finStat('perforasi', true);

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

			$scope.finishingchanged = function($name, $selected){
				if ($name == "Laminasi")
				{
					if($selected.id > 0)
						$scope.finSelect('varnish', 0);

					if ($selected.optionname.toLowerCase().indexOf("matte") != -1)
						$scope.finStat('spot varnish', true); //SPOT UV
					else if ($selected.optionname.toLowerCase().indexOf("gloss") != -1)
						$scope.finStat('spot varnish', false); //SPOT UV
				}
				else if ($name == "Varnish")
				{
					if($selected.id > 0)
					{
						$scope.finStat('spot varnish', false); //SPOT UV
						$scope.finSelect('laminasi', 0); //LAMINATING DIBUAT JADI TANPA LAMINATING
					}
					else
						$scope.finStat('spot varnish', true);
				}

				$scope.getPrice();
			}

			$scope.selectFinIndex = function($text)
			{
				$index = -1;
				$.each($scope.finishings, function($i, $item) {
					if($item.finishing.name.toLowerCase() == $text)
					{
						$index = $i;
					}
				});
				return $index;
			}

			$scope.finSelect = function($text, $select)
			{
				$index = $scope.selectFinIndex($text);
				if($index == -1) return 0;
				if($scope.finishings[$index].finishing.finishingoption.length > $select)
				{ //KALAU LEBIH KECIL DARI LEBGTH
					if($select >= 0)
					{
						$scope.selected.finishings[$index] = $scope.finishings[$index].finishing.finishingoption[$select];
					}
				}
			}

			$scope.finOnly = function($text, $keyoptions)
			{
				$index = $scope.selectFinIndex($text);
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

			$scope.finStat = function($text, $enable){
				$index = $scope.selectFinIndex($text);
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

			$scope.finStat0 = function($text, $enable){
				$index = $scope.selectFinIndex($text);
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

			$scope.addSelectedFiles = function($file){
				$duplicated = false;
				$.each($scope.selected.files, function($index, $item){
					if($item.id == $file.id)
					{
						$duplicated = true;
					}
				});
				//kalo ga ada yang sama baru boleh add
				if($duplicated == false)
					$scope.selected.files.push($file);
			}

			$scope.remSelectedFiles = function($file){
				$selectedindex = -1;
				$.each($scope.selected.files, function($index, $item){
					if($item.id == $file.id)
					{
						$selectedindex = $index;
					}
				});
				//kalo ketemu, delete
				if($selectedindex != -1)
				{
					$scope.selected.files.splice($selectedindex, 1);
				}
			}

			$scope.refreshUploadedImage = function(){
				if(!$scope.loadingfiles)
				{
					$scope.loadingfiles = true;
					$http({
						"method"	: "GET",
						"url"			: API_URL+"pendimg"
					}).then(function(response){
						//console.log(response);

						if(response!=null)
						{
							if(response.data.constructor === Array)
							{
								$scope.uploadedfiles = response.data;
								if ($scope.uploadedfiles.length > 0) 
									$scope.tableshow = true;
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
							//console.log	('NO DATA in PendIMG');
						}
						$scope.loadingfiles = false;
					}).error(function(response, code){
						if(code==403)
						{
							$scope.restrictNotLogined();
						}
					});
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
				$scope.uploaderror = '';
				$scope.uploadwaiting = true;
				$scope.loadingfiles = true;

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
						$ext != 'indd') //indesign
					{
						//FORMAT NGACOK
						$scope.uploaderror = value.name+" : tidak bisa upload dengan file format "+$ext+".";
					}
					else if(value.size > 50 * 1024 * 1024)
					{
						$scope.uploaderror = value.name+" : file terlalu besar.";
					}
					else 
					{
						$scope.uploaderror = "";
						//BERHASIL -> ADD files[] ke data
						data.append("files[]", value);
						//data.append('jobsubtypeID', $scope.selected.jobsubtypeID);
						//jobsubtypeID -> dibuang, ditambahkan dengan user dapat 
					}
				});
				
				$http({
					method: 'POST',
					url: API_URL+'upload',
					data: data,
					withCredentials: true,
					headers: {'Content-Type': undefined },
					transformRequest: angular.identity
				}).then(function(response) {
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
						$scope.uploadedfiles = [];
						//console.log	('NO DATA in PendIMG');
					}
					$scope.loadingfiles = false;
					$scope.uploadwaiting = false;
					$scope.allowed();
				}).error(function(response, code) {
					if(code==403)
					{
						$scope.restrictNotLogined();
					}
					else
					{
						$scope.error.files = "Error file (error not detected), call customer service for this error";
					}
					$scope.uploadwaiting = false;
				});

				$scope.clearFileInput('file');
			};

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

			$('#real-dropzonew').on('change', function(e) 
			{ 
				e.preventDefault();
				e.stopPropagation();
				if ($(this)[0]['file'].files){
					if ($(this)[0]['file'].files.length > 0) {
						upload($(this)[0]['file'].files);
					}
				} 
				return false;
			});
		}
	]);
};