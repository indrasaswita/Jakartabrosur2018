<?php

/* HOME */
Route::any  ('home',    function(){ return redirect()->route('pages.home'); });
Route::any  ('/',   ['as'=>'pages.home', 'uses'=>'HomeController@index']);


Route::get  ('terms', 'TermController@index');
Route::get  ('aboutus', 'AboutusController@index');
Route::get  ('help', 'HelpController@index');

Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap/posts', 'SitemapController@posts');
Route::get('/sitemap/categories', 'SitemapController@categories');
Route::get('/sitemap/podcasts', 'SitemapController@podcasts');

Route::get("shop/{pages}", 'ShopController@show');
Route::get("orderlistcustomer", "ShopController@showlists");
Route::get('addresses/{id}', 'AddressController@show'); 

/* ACCOUNT LOG */
Route::get('login', ['as'=>'pages.account.login', 'uses'=>"UserController@loginpage"]);
Route::get('signup', ['as'=>'pages.account.signup', 'uses'=>"UserController@signuppage"]);
//Route::get('kirimulang', "UserController@resendemail");
//

//HARUS UDA LOGIN - BOLEH CUSTOMER BOLEH EMPLOYEE


//BUAT PAS KLIK DI LINK EMAIL
Route::get('/customer/verify/{token}', 'CustomerController@verifyEmail');
//BUAT MASUK KE VERIFICATION PAGES
Route::get('verification', ['as'=>'pages.verification', 'uses'=>'CustomerController@verification']);
Route::post('AJAX/verifycode', 'CustomerAJAX@verifywithcode');

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
/*Route::get('aice', 'AiceController@index');

Route::post('API/aice/save', 'AiceAPI@saveCart');

Route::get('API/aice/getSales', 'AiceAPI@getSales');
Route::get('API/aice/getGroup', 'AiceAPI@getSalesGroup');
Route::get('API/aice/master', 'AiceAPI@getAllAice');
Route::post('API/aice/master/push', 'AiceAPI@updateAice');*/


Route::group(['middleware'=>['loggedin']], function(){
	
	//HARUS SUDAH LOGIN (CUST/ADMIN)
	Route::get("sales/cartheader/{cartid}", 'AllaccCartheaderController@show');
});

Route::get('chpass', "ProfileController@changepass");
Route::post ('AJAX/userprofile/update/{id}', "ProfileAJAX@updateAll");
Route::post ('AJAX/chpass/update/{id}', "ProfileAJAX@updatePassword");
//customer address
Route::post('AJAX/custadds/edit/{id}', 'CustomeraddressAJAX@editaddress');
Route::post('AJAX/custadds/store/{custid}', 'CustomeraddressAJAX@store');

Route::group(['middleware'=>['loggedinAPI']], function(){
	Route::get  ("API/cartfiles",   "CartfileAPI@apiGetAll");
	Route::post("API/cartfiles/create", 'CartfileAPI@create');
	Route::get("API/cartfiles/custid/{custid}", 'CartfileAPI@getFileByCustomerID');
	Route::get("API/files/unbinded", "FileAPI@getFileUnbinded");
	//jasa pengiriman dsb
	Route::post("API/delivery", "DeliveryAPI@getAll");
	Route::post("API/deliveryprice", "DeliveryAPI@getHarga");
	Route::get("AJAX/company/all", "CompanyAJAX@getAll");
	Route::post("AJAX/profile/update/{id}/company", "CompanyAJAX@updateByCompany");
	
	Route::post('AJAX/notification/view/{id}', 'NotificationAJAX@setviewed');
	Route::post('AJAX/paper/changecoatingtype', 'AdmPaperAJAX@changecoatingtype');

	
});

/*** CUSTOMER WEB ***/
/*** CUSTOMER WEB ***/
/*** CUSTOMER WEB ***/
Route::group(['middleware'=>['verified']], function(){
	Route::get('upload',  ['as'=>'pages.order.upload', 'uses'=>'UploadController@index']);
	Route::get('payment/confirm/{id}', 'PaymentController@confirmShow');
	Route::get('upload',  'UploadController@index');
	Route::get('profile', "ProfileController@index");
	Route::get('payment/{id}', 'PaymentController@show');
	Route::get('cart', 'CartController@index');
	Route::get('sales/all', 'AllSalesCustomerView@index');
	Route::get('AJAX/file/{id}/download', 'FileAJAX@downloadByFileID');
	Route::get('AJAX/file/preview/{id}/download', 'FileAJAX@downloadPreviewByFileID');

	Route::post('AJAX/custbankaccs/save', 'CustomerbankaccAJAX@insert');
	Route::post('AJAX/custbankaccs/{id}/update', 'CustomerbankaccAJAX@update'); //belom kepake tapi uda di buat

	Route::post('AJAX/salespayment/insert', 'SalespaymentAJAX@insert');

	Route::get('notification', 'NotificationController@index'); // di employee juga ada
});

/*** EMPLOYEE WEB ***/
/*** EMPLOYEE WEB ***/
/*** EMPLOYEE WEB ***/
/*** EMPLOYEE WEB ***/
Route::group    (['middleware'=>['employee']], function(){
	Route::get('admin/addusernopass', 'AdmCustomerController@addusernopass');
	Route::resource ('roles',   "RoleController");
	Route::get ('admin/master/customer',    "CustomerController@index");
	Route::get ('admin/master/calendar',    "AdmCalendarController@index");
	Route::get  ('cartdetails/cartfiles/download/{id}', 'CartdetailController@downloadByFileID');
	Route::get('admin/master/ctw/database', "AdmChangetheworldController@index");

	//ADMIN WEB 
	Route::get('admin/tracking', 'AdmTrackingController@index');
	Route::resource ('admin/allsales',  'AdmAllSalesController');
	Route::get("admin/cart", 'AdmCartController@index');
	Route::get("admin/setcartperuser", "AdmCartController@joincart");
	Route::get('admin/pricetext', 'AdmPricetextController@index');

	Route::get("admin/payment/invoice/{id}", 'PaymentController@showInvoiceAdmin');


	//ADMIN MASTER WEB
	Route::get('admin/master/onesignal', 'AdmOnesignalController@index');
	Route::get("admin/master/pricepaper", 'AdmPaperController@changeprice');
	Route::get("admin/master/newpaper", 'AdmPaperController@newpaper');
	Route::get("admin/master/finishings", 'AdmFinishingController@master');
	Route::get("admin/master/vendor", 'AdmVendorController@master');
	Route::get("admin/master/paperdetailstore", 'AdmPaperController@paperdetailstore');
	Route::get("admin/master/shoppricing", 'AdmShoppricingsController@index');
	Route::get('admin/master/jobeditor', 'AdmJobeditorController@index');
	Route::get('admin/master/jobsizeeditor', 'AdmJobeditorController@jobsizes');
	Route::get('admin/master/jobpapereditor', 'AdmJobeditorController@jobpapers');
	Route::get('admin/master/jobfinishingeditor', 'AdmJobeditorController@jobfinishings');
	Route::get('admin/master/jobquantityeditor', 'AdmJobeditorController@jobquantities');
	Route::get('admin/master/jobactivation', 'AdmJobeditorController@activationjob');

	//belom selesai
	Route::get("admin/master/pendingcustomer", 'AdmCustomerController@pendingOnly');
	Route::get("admin/master/pendingcompany", 'AdmCompanyController@pendingOnly');
	//Route::get('admin/sales/commit/{id}/{sid}/{tk}', 'AdmSalesdetailController@showCommitByID');

	//PRINT PRINT PRINT
	Route::get("sales/printlist/pdf", 'AdmJadwalCetak@createJadwalCetakPDF');
	Route::get("sales/paperlist/pdf", 'AdmBeliKertas@createBeliKertasPDF');
	Route::get("admin/sales/delivery/{id}/pdf", 'AdmSalesdeliveryController@print');


	Route::get('notification', 'NotificationController@index'); // di customer juga ada
	Route::get("admin/companybankacc/mutasi", "AdmCompanyaccountsController@index");
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

//GA PERLU LOGIN?
Route::get('AJAX/custaccs', 'CustomeraccountAJAX@all');
Route::post('AJAX/custaccs/store', 'CustomeraccountAJAX@store');
Route::post("AJAX/cekharga", 'Calculation@calcPrice');
Route::get('AJAX/faquestions', 'FaquestionsAJAX@getByGroup');


Route::get  ("API/cartfiles/{cartID}",  "CartfileAPI@getFileByCartID"); // HARUS SUDAH LOGIN
Route::get("API/cartfiles/{id}/delete", 'CartfileAPI@deleteCartfileByID'); // harus sudah login

//HARUS LOGIN CUSTOMER
Route::post('AJAX/files/saveurl', 'FileAJAX@saveurl');
Route::post('AJAX/files/savedetail', 'FileAJAX@savedetail');
Route::get('AJAX/allsales/filterorder/{link}', 'AllSalesCustomerAJAX@filterorder');

//HARUS LOGIN ADMIN
Route::get('AJAX/admin/ctw/getbytablename/{table}', 'AdmChangetheworldAJAX@getByTablename');
Route::get('AJAX/sendnotif', 'NotificationAJAX@sendtestnotif');
Route::post("AJAX/shoppricing/finishing/update", 'AdmShoppricingsAJAX@updatefinishing');
Route::post("AJAX/shoppricing/constant/update", 'AdmShoppricingsAJAX@updateconstant');
Route::post("AJAX/shoppricing/constant/insert", 'AdmShoppricingsAJAX@insertconstant');
Route::post("AJAX/jobsubtype/{id}/activate", 'AdmJobeditorAJAX@activatejobsubtype');
Route::post('AJAX/jobsubtypepaper/store', "AdmJobsubtypepaperAJAX@store");
Route::post('AJAX/jobsubtypepaper/remove', "AdmJobsubtypepaperAJAX@delete");
Route::post("AJAX/jobsubtypepaper/{id}/changefavourite", "AdmJobsubtypepaperAJAX@changefavourite");
Route::post("AJAX/jobsubtypefinishing/{id}/changemustdo", "AdmJobsubtypefinishingAJAX@changemustdo");
Route::post("AJAX/jobsubtypefinishing/savenewfinishing", "AdmJobsubtypefinishingAJAX@store");
Route::post("AJAX/jobsubtypequantity/{id}/changeofdg", "AdmJobsubtypequantityAJAX@changeofdg");
Route::post("AJAX/jobsubtypequantity/{id}/changequantity", "AdmJobsubtypequantityAJAX@changequantity");
Route::post("AJAX/jobsubtypequantity/addnewjobquantity", "AdmJobsubtypequantityAJAX@addnewjobquantity");
Route::post("AJAX/jobsubtypequantity/{id}/delete", "AdmJobsubtypequantityAJAX@deletejobsubtypequantity");
Route::post("AJAX/jobsubtypesize/store", "AdmJobsubtypesizeAJAX@store");

Route::post("AJAX/finishingoption/priceminim/update", 'AdmFinishingoptionAJAX@updatepriceminim');
Route::post("AJAX/finishingoption/pricebase/update", 'AdmFinishingoptionAJAX@updatepricebase');
Route::post("AJAX/finishingoption/price/update", 'AdmFinishingoptionAJAX@updateprice');

Route::post("AJAX/paper/{id}/changepaper/{col}", "AdmPaperAJAX@changepaperdetail"); //semua change paper detail diatur disini
Route::post("AJAX/paper/{id}/changepapertype", "AdmPaperAJAX@changepapertypeID");
Route::post("AJAX/paper/savenewpaper", "AdmPaperAJAX@addnewpaper");
Route::post("AJAX/paperdetail/savenewplano", "AdmPaperdetailAJAX@savenewplano");
Route::post("AJAX/jobsubtypepaper/{id}/changeofdg", "AdmJobsubtypepaperAJAX@changeofdg");
Route::post("AJAX/jobsubtypesize/{id}/changeofdg", "AdmJobsubtypesizeAJAX@changeofdg");
Route::post("AJAX/master/customer/saveusernopass", "AdmCustomerAJAX@saveusernopass");
Route::post("AJAX/master/customer/updateusernopass", "AdmCustomerAJAX@updateusernopass");

/* LOGIN LOGOUT ACCOUNT */
Route::post ('AJAX/login',   'AllUserAJAX@login');
Route::post ('AJAX/makepassword',   'AllUserAJAX@makepassword');
Route::post('AJAX/checkmail', 'AllUserAJAX@checkMail');
Route::get('logout',  'AllUserAJAX@logout');


/*END ACCOUNT ROUTE*/


Route::get  ("API/data/customers/name", "CustomerAPI@apiGetName");
Route::get  ("API/salesdetails/{id}/header", ["as"=>"api.salesdetails.view", "uses"=>"SalesdetailController@apiGetSpecific"]);
Route::get  ("API/cartdetails/{id}/header", ["as"=>"api.cartdetails.view", "uses"=>"CartdetailController@apiGetSpecificBySalesID"]);
Route::post ("API/cartdetails/title/update", "CartdetailController@apiUpdateTitle"); 
	


/** GLOBAL CALCULATION ORDER **/
//dipake di ordercustomerlist


Route::post("API/calc/planosize", "Calculation@calcPlanoSize_url");

/*** EMPLOYEE API ***/
/*** EMPLOYEE API ***/
/*** EMPLOYEE API ***/
/*** EMPLOYEE API ***/
Route::group(['middleware'=>"employeeAPI"], function(){
	Route::post("AJAX/admin/cart/{cartid}/changecustomer/{custid}", "AdmCartAJAX@changecustomerID");
	Route::get('AJAX/customers', 'AdmCustomerAJAX@getcustomers');

	Route::post('AJAX/commit/cartpreview/{id}/undo', 'AdmCartpreviewAJAX@undofile');
	Route::post('AJAX/admin/cartpreview/{id}/delete', 'AdmCartpreviewAJAX@deleteFile');
	Route::get('AJAX/admin/file/{id}/download', 'AdmFileAJAX@downloadByFileID');
	Route::get('AJAX/admin/previewfile/{id}/download', 'AdmFileAJAX@downloadPreviewByFileID');
	Route::post ('AJAX/upload/preview/{cartid}', 'ImageController@previewUploadEmployee');
	Route::post ('API/upload/original/{custid}/{cartid}',   ['as' => 'upload-post', 'uses' =>'ImageController@originalUploadEmployee']);

	//change status tracking
	Route::post('API/admin/tracking/chstfile', 'AdmChangeTrackingAPI@changeStatusFile');
	Route::post('API/admin/tracking/chstctp', 'AdmChangeTrackingAPI@changeStatusCTP');
	Route::post('API/admin/tracking/chstprint', 'AdmChangeTrackingAPI@changeStatusPrint');
	Route::post('API/admin/tracking/chstpackaging', 'AdmChangeTrackingAPI@changeStatusPacking');
	Route::post('API/admin/tracking/chstdelivery', 'AdmChangeTrackingAPI@changeStatusDelivery');
	Route::post('API/admin/tracking/chstdone', 'AdmChangeTrackingAPI@changeStatusDone'); //HARUSNYA DARI CUSTOMER - NANTI HARUS DI GANTI LAGI

	Route::get('AJAX/bankaccs/customer/{id}', 'CustomerbankaccAJAX@getByCustID');
	Route::post('AJAX/admin/payment/{id}', 'AdmSalespaymentAJAX@setPaymentByID');
	Route::post('API/admin/master/paper/update', "AdmPaperAPI@updateManyRows");

	//VERIFIKASI PEMBAYARAN
	Route::get  ('API/verif',   'AdmAllSalesAPI@apiGetVerif');
	Route::post ('API/admin/verif/store',   'AdmAllSalesAPI@apiVerif');

	Route::post ('API/cartheaders/filestatus/setOK/{id}', 'CartheaderAPI@apiFileStatusSetOk'); //ADMIN + SETTING ONLY
	Route::post ('API/cartheaders/filestatus/setNOTOK/{id}', 'CartheaderAPI@apiFileStatusSetOk'); // ADMIN + SETTING ONLY

	Route::post ('API/admin/cart/employeenote', 'AdmCartAPI@updateEmployeeNote');
	Route::post("AJAX/admin/cart/checkout", "AdmCartAJAX@checkout");


		//PARAMETER $id => salesID
	Route::post ("API/admin/sales/delivery/{id}/store", 'AdmSalesdeliveryAPI@store');
	Route::post ("API/admin/sales/delivery/update", 'AdmSalesdeliveryAPI@update');

	//CART ADMIN
	Route::post("API/admin/cart/store", "AdmCartAPI@addNewCart");
	Route::get("API/admin/cart/{id}/delete", 'AdmCartAPI@deleteCart');

	//AJAX FROM EMPLOYEE ROLE
	Route::post("AJAX/jobeditor/jobsubtypes/update", 'AdmJobeditorAJAX@updatejobsubtype');
});

/*** CUSTOMER API ***/
/*** CUSTOMER API ***/
/*** CUSTOMER API ***/
/*** CUSTOMER API ***/
Route::group(['middleware'=>"customerAPI"], function(){

	Route::post('AJAX/cartfiles/{cartid}/upload', 'ImageController@originalUploadCustomerByCart');
	Route::post('AJAX/cartfiles/{cartid}/revision/{fileid}', 'ImageController@reviseUploadCustomer');

	Route::post('API/order/tracking/chstdone', 'ChangeTrackingAPI@changeStatusDone');

	Route::post('API/upload',  ['as' => 'upload-post', 'uses' =>'ImageController@originalUploadCustomer']);
	Route::post('API/upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);
	Route::get('API/pendimg', ['as'=>'upload-pendimg', 'uses' => 'ImageController@getPendingImage']);
	Route::post('AJAX/carts/changefile/save', 'CartfileAJAX@savefile');

	Route::post('AJAX/cart/delete', 'CartAJAX@cartDelete');
	Route::post('AJAX/cart/duplicate', 'CartAJAX@cartDuplicate');
	Route::post('AJAX/cart/edittitle', 'CartAJAX@cartChangeTitle');
	Route::post('AJAX/sales/create', 'CartAJAX@createHeader');
	Route::get('AJAX/cartcheck/{cartID}', 'CartAJAX@cartCheck');
	Route::post("AJAX/shop/storecart", 'ShopController@storeCart');
	Route::post("AJAX/shop/updatecart", 'ShopController@storeCart');
	Route::post("API/cartdetails/delete", "CartController@setToDeleted");
	Route::post('API/payment/confirm', 'PaymentController@confirmStore');
	Route::get("API/addresses/custactive", "AddressAPI@apiGetByActiveCustomer");
	Route::get("API/addresses/customeraddress", 'CustomerAPI@apiGetAddressByActiveCustomer');
	Route::post("AJAX/sales/{id}/commit", "AllSalesCustomerAJAX@commit");
});




//SEMUA BISA AMBIL
Route::get('AJAX/compaccs',  "CompanybankaccAJAX@getAll");


Route::get('API/banks', ["as"=>"api.bank", "uses"=>"BankAPI@getAll"]);
//master
Route::get('API/company/getpending', 'CompanyAPI@getPending');
Route::get('API/companies', 'CompanyAPI@getAll');

//testing tampilan untuk kirim email
Route::get('contohemail', 'CustomerController@panggilemail');

//history sales order customer
Route::get('saleshistory', 'SalesdetailController@historySalesCustomer');
