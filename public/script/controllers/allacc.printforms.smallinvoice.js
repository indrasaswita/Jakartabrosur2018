module.exports = function(app){
	app.controller('AllSmallInvoiceController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){

			$scope.initData = function($data){
				$scope.sales = JSON.parse($data);
				if($scope.sales!=null){
					$scope.sales.created_at = $scope.makeDateTime($scope.sales.created_at);

					$scope.sales.totalpay = 0;
					$scope.sales.totalsales = 0;
					$.each($scope.sales.salesdetail, function($i, $ii){
						$scope.sales.totalsales += ($ii.cartheader.printprice + $ii.cartheader.deliveryprice - $ii.cartheader.discount);
					});
					$.each($scope.sales.salespayment, function($i, $ii){
						if($ii.salespaymentverif != null){
							$scope.sales.totalpay += ($ii.ammount);
						}
					});
				}
			}

			$scope.printCard = function(){
				//1. generate an image of HTML content through html2canvas utility
				$window.scrollTo(0, $('#card').offset().top-5);

				html2canvas($("#card")[0]).then(function (canvas) {
					var b64Prefix = "data:image/jpg;base64,";
					var imgBase64DataUri = canvas.toDataURL("image/jpg");
					var imgBase64Content = imgBase64DataUri.substring(b64Prefix.length, imgBase64DataUri.length);


					var winparams = 'dependent=no,locationbar=no,scrollbars=no,menubar=no,'+
						'resizable,screenX=0,screenY=0,width=1000,height=500';

					var bootstrap = '<link async rel="stylesheet" href="'+BASE_URL+'css/bootstrap.css?version=0.1">';

					var scss = "<style type='text/css' media='print'>"
							+"@page "
							+"{ "
							+"	size: auto;   /* auto is the initial value */"
							+"margin: 0mm; "
							+"	/*this affects the margin in the printer settings */"
							+"}"
							+"</style>"
							+"<link async rel='stylesheet' href='"+BASE_URL+"css/onlyprint.css'>";
					//scss to remove HEADER AND FOOTER

					var prebarcode = '<div class="text-xs-center"><img src="'+BASE_URL+'\\image\\logo-transp\\logo-print.png" width="100%"></div><br>';


					prebarcode += 'Tgl. '+$scope.zeroFill($scope.sales.created_at.getDate(), 2)+'/'+$scope.zeroFill($scope.sales.created_at.getMonth(), 2)+'/'+$scope.sales.created_at.getFullYear()+' -- '+$scope.sales.customer.name+', '+$scope.sales.customer.phone1+' -- ';

					if($scope.sales.totalpay > $scope.sales.totalsales){
						'KELEBIHAN BAYAR: '+(sales.totalpay-sales.totalsales).toString().addThousandSeparator();
					}else if($scope.sales.totalpay == $scope.sales.totalsales){
						prebarcode += 'LUNAS';
					}else{
						prebarcode += 'TOTAL TAGIHAN: '+($scope.sales.totalsales-$scope.sales.totalpay).toString().addThousandSeparator();	
					}

					var afterbarcode = "<div class='barcode-label'>";
					prebarcode += '<br>';
					if($scope.sales.totalpay >= $scope.sales.totalsales){
						prebarcode += 'STATUS CETAK & DETAIL';
						afterbarcode += '114'+$scope.zeroFill($scope.sales.id, 8);
					}else{
						prebarcode += 'UNTUK MELAKUKAN PEMBAYARAN';
						afterbarcode += '112'+$scope.zeroFill($scope.sales.id, 8);
					}
					afterbarcode += '</div>';

					afterbarcode += '<hr style="border-top: 2px solid black;">';
					$totalharga = 0;
					$.each($scope.sales.salesdetail, function($i, $salesdetail){
						var subtotal = $salesdetail.cartheader.printprice+$salesdetail.cartheader.deliveryprice-$salesdetail.cartheader.discount;

						afterbarcode += '<div class="">'
							+ $salesdetail.cartheader.jobsubtype.name
							+ '<span class="pull-xs-right">'
							+ 'Deliv: '
							+ $salesdetail.cartheader.delivery.deliveryname
							+ '</span>'
							+ '<br>' 
							+ $salesdetail.cartheader.jobtitle
							+ '</div>'
							+	'<div class="">'
							+ $salesdetail.cartheader.quantity.toString().addThousandSeparator()
							+ ' ' + $salesdetail.cartheader.quantitytypename
							+ '<span class="pull-xs-right">'
							+ (subtotal).toString().addThousandSeparator()
							+ '</span>'
							+ '</div>';


							$.each($salesdetail.cartheader.cartdetail, function($j, $cartdetail){
								afterbarcode += '<div class="">'
									+ '>> '+$cartdetail.cartname+'<br>'
									+ ($cartdetail.jobtype=='OF'?"OFFSET":$cartdetail.jobtype=='DG'?"DIGITAL":"OTHER")
									+ ' ' + $cartdetail['imagewidth']
									+ 'x' + $cartdetail['imagelength'] + 'CM -- '
									+ $cartdetail.paper.papertype.name + ': '
									+ $cartdetail.paper.name + ' '
									+ $cartdetail.paper.color + ' '
									+ $cartdetail.paper.gramature + 'gsm'
									+ '</div>';

									$.each($cartdetail.cartdetailfinishing, function($k, $cartdetailfinishing){

										afterbarcode += '<div class="">'
											+	'- ' + $cartdetailfinishing.finishing.name
											+ ', '
											+ $cartdetailfinishing.finishingoption.optionname
											+ '</div>';
									});
							});
						afterbarcode += '<hr style="border-top: 2px solid black;">';
						$totalharga += subtotal;
					});

					afterbarcode += '<div class="text-xs-right">'
						+ 'Total '
						+ $totalharga.toString().addThousandSeparator()
						+ '</div>';

					afterbarcode += '<br><br>';
					afterbarcode += '<hr style="border-top: 2px solid black;">';
					afterbarcode += '<div class="text-xs-center">Terima kasih telah ';
					afterbarcode += 'berbelanja di Jakartabrosur.com</div>';

					var htmlPop = scss
							+ '<div class="view-small-invoice">'
							+	prebarcode
							+ '<img '
						 + ' type="application/pdf"'
						 + ' style="margin: 5px 0;"'
						 + ' width="100%"'
						 + ' src="data:application/pdf;base64,'
						 + imgBase64Content
						 + '">'
						 + afterbarcode
						 + '</div>'; 

					var printWindow = window.open ("", "PDF", winparams);
					printWindow.document.write (scss+htmlPop);
					printWindow.document.close();
					//$("#card").hide();

					var intv = setInterval(function(){
						printWindow.focus();
						printWindow.print();
						clearInterval(intv);
						//printWindow.close();
					}, 200);


				});
			}
		}
	]);
}