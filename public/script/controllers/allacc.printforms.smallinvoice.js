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

			$scope.printCardMaster = function(linewidth){

				var winparams = 'dependent=no,locationbar=no,scrollbars=no,menubar=no,'+
					'resizable,screenX=450,screenY=0,width=270,height=500';

				var bootstrap = '<link async rel="stylesheet" href="'+BASE_URL+'css/bootstrap.css?version=0.2">';

				var scss = "<style type='text/css' media='print'>"
						+"@page "
						+"{ "
						+"	size: auto;   /* auto is the initial value */"
						+"margin: 0mm; "
						+"	/*this affects the margin in the printer settings */"
						+"}"
						+"</style>"
						+"<script src='"+BASE_URL+"js/jquery.min.js'></script>"
						+"<script src='"+BASE_URL+"script/constants/JsBarcode.ean-upc.min.js'></script>"
						+"<link async rel='stylesheet' href='"+BASE_URL+"css/onlyprint.css'>";
				//scss to remove HEADER AND FOOTER

				var prebarcode = app.logoforprint;


				prebarcode += $scope.zeroFill($scope.sales.created_at.getDate(), 2)+'/'+$scope.zeroFill($scope.sales.created_at.getMonth(), 2)+'/'+$scope.sales.created_at.getFullYear()+' '+$scope.sales.customer.name+' '+$scope.sales.customer.phone1+'<br><br>';


				var afterbarcode = "<div class='barcode-label'>";
				var barcode = "";
				if($scope.sales.totalpay >= $scope.sales.totalsales){
					prebarcode += 'STATUS CETAK & DETAIL';
					barcode = '114'+$scope.zeroFill($scope.sales.id, 8);
					//afterbarcode += barcode;
				}else{
					prebarcode += 'UNTUK MELAKUKAN PEMBAYARAN';
					barcode = '112'+$scope.zeroFill($scope.sales.id, 8);
					//afterbarcode += barcode;
				}
				afterbarcode += '</div>';
				prebarcode += '<br>';

				if($scope.sales.totalpay > $scope.sales.totalsales){
					prebarcode += 'KELEBIHAN BAYAR: '+(sales.totalpay-sales.totalsales).toString().addThousandSeparator();
				}else if($scope.sales.totalpay == $scope.sales.totalsales){
					prebarcode += 'LUNAS';
				}else{
					prebarcode += 'TOTAL TAGIHAN: '+($scope.sales.totalsales-$scope.sales.totalpay).toString().addThousandSeparator();	
				}


				afterbarcode += '<hr style="border-top: '+linewidth+'px solid black; margin: 2px 0;">';
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
							afterbarcode += '<div class="">';
							if($salesdetail.cartheader.cartdetail.length>1)
								afterbarcode += '> <b>'+$cartdetail.cartname+'</b><br>';
							afterbarcode += ($cartdetail.jobtype=='OF'?"OFFSET":$cartdetail.jobtype=='DG'?"DIGITAL":"OTHER")
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
					afterbarcode += '<hr style="border-top: '+linewidth+'px solid black; margin: 2px 0;">';
					$totalharga += subtotal;
				});

				afterbarcode += '<div class="text-xs-right">'
					+ 'Total '
					+ $totalharga.toString().addThousandSeparator()
					+ '</div>';

				afterbarcode += '<br><br>';
				afterbarcode += '<hr style="border-top: '+linewidth+'px solid black; margin: 2px 0;">';
				afterbarcode += '<div class="text-xs-center">Terima kasih telah ';
				afterbarcode += 'berbelanja di Jakartabrosur.com</div>';

				var htmlPop = scss
						+ '<div class="view-small-invoice">'
						+	prebarcode
						+ '<div class="text-xs-center">'
						+ '	<svg class="barcode"'
						+	'		jsbarcode-format="upc"'
						+	'		jsbarcode-value="'+barcode+'"'
						+	'		jsbarcode-textmargin="0"'
						+	'		jsbarcode-margintop="5"'
						+	'		jsbarcode-marginright="0"'
						+	'		jsbarcode-marginbottom="2"'
						+	'		jsbarcode-marginleft="0"'
						+	'		jsbarcode-height="25"'
						+	'		jsbarcode-fontsize="10"'
						+	'		jsbarcode-fontoptions="normal">'
						+	'	</svg>'
						+ '</div>'
						+ afterbarcode
						+ '</div>'
						+ '<script>'
						+ 'JsBarcode(".barcode").init();'
						+ '</script>'; 

				var printWindow = window.open ("", "PDF", winparams);
				printWindow.document.write (scss+htmlPop);
				printWindow.document.close();

				var intv = setInterval(function(){
					printWindow.focus();
					printWindow.print();
					clearInterval(intv);
					//printWindow.close();
				}, 200);

			}


			$scope.printCard54 = function(){
				$scope.printCardMaster(2);
			}


			$scope.printCard80 = function(){
				$scope.printCardMaster(1);
			}
		}
	]);
}