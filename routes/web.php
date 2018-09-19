<?php


/* HOME */
Route::any	('home',	function(){ return redirect()->route('pages.home'); });
Route::any	('/',	['as'=>'pages.home', 'uses'=>'HomeController@index']);
Route::get  ('terms', 'TermController@index');
Route::get  ('aboutus', 'AboutusController@index');
Route::get  ('help', 'HelpController@index');

//buat test doang
Route::get('session/set', 'UserController@set');
Route::get('session/get', 'UserController@get');
Route::get('session/remove', 'UserController@remove');

Route::get("shop/{pages}", 'ShopController@show');
Route::resource("shop", 'ShopController');
Route::resource("orderlistcustomer", "OrderListCustomerController");
Route::get('addresses/{id}', 'AddressController@show'); 

/* ACCOUNT LOG */
Route::get('login', ['as'=>'pages.account.login', 'uses'=>"UserController@loginpage"]);
Route::get('signup', ['as'=>'pages.account.signup', 'uses'=>"UserController@signuppage"]);

//HARUS UDA LOGIN - BOLEH CUSTOMER BOLEH EMPLOYEE
Route::get	('chpass', "ProfileController@changepass");

/* LOGIN LOGOUT ACCOUNT */
Route::get	('logout',	'UserController@logout');
Route::get	('register',	'CustomerController@signupindex');

/** ERRORS **/
Route::get("forbidden", 'ErrorController@forbidden');
Route::get("notfound", 'ErrorController@notfound');

/* PRINTING PRINTING PRINTING PRINTING PRINTING */
/* PRINTING PRINTING PRINTING PRINTING PRINTING */
/* PRINTING PRINTING PRINTING PRINTING PRINTING */ 
/* PRINTING PRINTING PRINTING PRINTING PRINTING */
Route::get("payment/invoice/pdf/{id}", 'PaymentController@createInvoicePDF');
Route::get("payment/offering/pdf/{id}", 'PaymentController@createOfferingPDF');

/* AICE */
Route::get('aice', 'AiceController@index');

Route::post('API/aice/save', 'AiceAPI@saveCart');

Route::get('API/aice/getSales', 'AiceAPI@getSales');
Route::get('API/aice/getGroup', 'AiceAPI@getSalesGroup');
Route::get('API/aice/master', 'AiceAPI@getAllAice');
Route::post('API/aice/master/push', 'AiceAPI@updateAice');


/*** CUSTOMER WEB ***/
/*** CUSTOMER WEB ***/
/*** CUSTOMER WEB ***/
Route::group	(['middleware'=>'customer'], function(){
	Route::get	('upload',	['as'=>'pages.order.upload', 'uses'=>'UploadController@index']);
	Route::get	('payment/confirm/{id}', 'PaymentController@confirmShow');
	Route::resource ('upload',	'UploadController');
	Route::resource ('profile', "ProfileController@index");
	Route::resource ('payment',	'PaymentController');
	Route::get ('cart',	'CartController@index');
	Route::resource ('sales/all', 'AllSalesCustomerView');

	Route::get('sales/commit/{id}/{sid}/{tk}', 'SalesdetailController@showCommitByID');
});

/*** EMPLOYEE WEB ***/
/*** EMPLOYEE WEB ***/
/*** EMPLOYEE WEB ***/
/*** EMPLOYEE WEB ***/
Route::group	(['middleware'=>'employee'], function(){
	Route::resource ('roles',	"RoleController");
	Route::get ('admin/master/customer',	"CustomerController@index");
	Route::get	('cartdetails/cartfiles/download/{id}', 'CartdetailController@downloadByFileID');

	//ADMIN WEB 
	Route::get('admin/tracking', 'AdmTrackingController@index');
	Route::resource ('admin/allsales',	'AdmAllSalesController');
	Route::get("admin/cart", 'AdmCartController@index');

	//ADMIN MASTER WEB
	Route::get("admin/master/paper", 'AdmPaperController@index');

	//belom selesai
	Route::get("admin/master/pendingcompany", 'CompanyController@pendingOnly');
	//Route::get('admin/sales/commit/{id}/{sid}/{tk}', 'AdmSalesdetailController@showCommitByID');

	//PRINT PRINT PRINT
	Route::get("sales/workorder/pdf/{id}", 'PaymentController@createWorkOrderPDF');
	Route::get("sales/printlist/pdf", 'AdmJadwalCetak@createJadwalCetakPDF');
	Route::get("sales/paperlist/pdf", 'AdmBeliKertas@createBeliKertasPDF');
	Route::get ("admin/sales/delivery/{id}/pdf", 'AdmSalesdeliveryController@print');
});





//         AA       PPPPPPPPP     II
//        AAAA      PPPPPPPPPP    II
//       AA AA      PP      PPP   II
//       AA AA      PP       PP   II
//      AA   AA     PP       PP   II
//      AA   AA     PP       PP   II
//     AA    AA     PP       PP   II
//     AA     AA    PP       PP   II
//    AA      AA    PP      PP    II
//    AAAAAAAAAA    PPPPPPPPP     II
//   AAAAAAAAAAAA   PPPPPPPP      II
//   AA        AA   PP            II
//  AA         AA   PP            II
//  AA          AA  PP            II
// AA           AA  PP            II
// AA           AA  PP            II





Route::post	('API/chpass/update/{id}', "ProfileAPI@apiUpdatePassword"); // HARUS SUDAH LOGIN 
Route::get	("API/cartfiles/{cartID}",	"CartfileAPI@getFileByCartID"); // HARUS SUDAH LOGIN
Route::get("API/cartfiles/{id}/delete", 'CartfileAPI@deleteCartfileByID'); // harus sudah login


/* LOGIN LOGOUT ACCOUNT */
Route::post	('API/login',	'UserController@login');
Route::post	('API/register',	["as" => "api.regiter", "uses" => "CustomerController@store"]);


/*END ACCOUNT ROUTE*/

Route::get	("API/cartfiles",	"CartfileAPI@apiGetAll");
Route::post("API/cartfiles/create", 'CartfileAPI@create');
Route::get("API/cartfiles/custid/{custid}", 'CartfileAPI@getFileByCustomerID');
Route::get("API/files/unbinded", "FileAPI@getFileUnbinded");


Route::get	("API/data/customers/name", "CustomerAPI@apiGetName");
Route::get	("API/papers",	["as"=>"api.papers", "uses"=>"PaperAPI@apiGetAll"]);

Route::get	("API/salesdetails/{id}/header", ["as"=>"api.salesdetails.view", "uses"=>"SalesdetailController@apiGetSpecific"]);
Route::get	("API/cartdetails/{id}/header", ["as"=>"api.cartdetails.view", "uses"=>"CartdetailController@apiGetSpecificBySalesID"]);
Route::post	("API/cartdetails/title/update", "CartdetailController@apiUpdateTitle"); 
 


/** GLOBAL CALCULATION ORDER **/
//dipake di ordercustomerlist
Route::get("API/jobsubtypes/getactive", "JobsubtypeController@getactive");

//jasa pengiriman dsb
Route::post("API/delivery", "DeliveryAPI@getAll");
Route::post("API/deliveryprice", "DeliveryAPI@getHarga");

Route::post("API/cekharga", 'Calculation@getPrice');
Route::post("API/calc/planosize", "Calculation@calcPlanoSize_url");


/*** EMPLOYEE API ***/
/*** EMPLOYEE API ***/
/*** EMPLOYEE API ***/
/*** EMPLOYEE API ***/
Route::group(['middleware'=>"employeeAPI"], function(){
	Route::post	('API/upload/preview/{id}',	['as' => 'upload-post', 'uses' =>'ImageController@uploadPreview']);
	Route::post	('API/upload/original/{custid}/{cartid}',	['as' => 'upload-post', 'uses' =>'ImageController@originalUploadEmployee']);

	//change status tracking
	Route::post('API/admin/tracking/chstfile', 'AdmChangeTrackingAPI@changeStatusFile');
	Route::post('API/admin/tracking/chstctp', 'AdmChangeTrackingAPI@changeStatusCTP');
	Route::post('API/admin/tracking/chstprint', 'AdmChangeTrackingAPI@changeStatusPrint');
	Route::post('API/admin/tracking/chstpackaging', 'AdmChangeTrackingAPI@changeStatusPacking');
	Route::post('API/admin/tracking/chstdelivery', 'AdmChangeTrackingAPI@changeStatusDelivery');
	Route::post('API/admin/tracking/chstdone', 'AdmChangeTrackingAPI@changeStatusDone'); //HARUSNYA DARI CUSTOMER - NANTI HARUS DI GANTI LAGI

	Route::post('API/admin/payment/{id}', 'AdmSalesPaymentAPI@setPaymentByID');
	Route::post('API/admin/master/paper/update', "AdmPaperAPI@updateManyRows");

	//VERIFIKASI PEMBAYARAN
	Route::get	('API/verif',	'AdmAllSalesAPI@apiGetVerif');
	Route::post	('API/admin/verif/store',	'AdmAllSalesAPI@apiVerif');

	Route::post	('API/cartheaders/filestatus/setOK/{id}', 'CartheaderAPI@apiFileStatusSetOk'); //ADMIN + SETTING ONLY
	Route::post	('API/cartheaders/filestatus/setNOTOK/{id}', 'CartheaderAPI@apiFileStatusSetOk'); // ADMIN + SETTING ONLY

	Route::post ('API/admin/cart/employeenote', 'AdmCartAPI@updateEmployeeNote');


  //PARAMETER $id => salesID
	Route::post ("API/admin/sales/delivery/{id}/store", 'AdmSalesdeliveryAPI@store');
	Route::post ("API/admin/sales/delivery/update", 'AdmSalesdeliveryAPI@update');

	//CART ADMIN
	Route::post("API/admin/cart/store", "AdmCartAPI@addNewCart");
	Route::get("API/admin/cart/{id}/delete", 'AdmCartAPI@deleteCart');
});

/*** CUSTOMER API ***/
/*** CUSTOMER API ***/
/*** CUSTOMER API ***/
/*** CUSTOMER API ***/
Route::group(['middleware'=>"customerAPI"], function(){

	Route::post('API/cartfiles/{cartid}/upload', 'ImageController@originalUploadCustomerByCart');

	Route::post('API/order/tracking/chstdone', 'ChangeTrackingAPI@changeStatusDone');

	Route::post	('API/upload',	['as' => 'upload-post', 'uses' =>'ImageController@originalUploadCustomer']);
	//Route::post	('API/upload/throw', 'ImageController@dzThrow');
	Route::post	('API/upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);
	Route::get	('API/pendimg', ['as'=>'upload-pendimg', 'uses' => 'ImageController@getPendingImage']);
	Route::post	('API/profile/update/{id}', "ProfileAPI@apiUpdateAll");
	Route::post	('API/cart/delete',	'CartController@cartDelete');
	Route::post	('API/sales/create', 'CartController@createHeader');
	Route::post("API/storecartdetail", 'ShopController@storingData');
	Route::post("API/cartdetails/delete", "CartController@setToDeleted");
	Route::post('API/payment/confirm', 'PaymentController@confirmStore');
	Route::get("API/addresses/custactive", "AddressAPI@apiGetByActiveCustomer");
	Route::get("API/addresses/customeraddress", 'CustomerAPI@apiGetAddressByActiveCustomer');
	Route::post("API/sales/{id}/commit", "AllSalesCustomerAPI@commit");
});


Route::get('API/bankaccs/customer/{id}', 'CustomerBankAccAPI@getByID');
Route::get('API/compaccs',	["as"=>"api.compaccs", "uses"=>"CompanyBankAccAPI@getAll"]);
Route::get('API/custaccs',	["as"=>"api.custaccs", "uses"=>"CustomerBankAccAPI@getAll"]);
Route::get('API/banks',	["as"=>"api.bank", "uses"=>"BankAPI@getAll"]);
//master
Route::get('API/company/getpending', 'CompanyAPI@getPending');
Route::get('API/companies', 'CompanyAPI@getAll');