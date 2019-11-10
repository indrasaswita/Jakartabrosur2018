<?php

use Illuminate\Http\Request;


Route::get('/jobsubtype/{pages}', 'JobsubtypeAPI@showbylink');
Route::post('/pricetext/save', 'PricetextAPI@insert');
Route::get('/admin/vendor/papershop', 'VendorAPI@papershop');
Route::get('/admin/vendor/allshop', 'VendorAPI@allshop');
Route::get('/coatingtypes', 'CoatingtypeAPI@getAll');
Route::get('/papertypes', 'PapertypeAPI@getAll');
Route::get('/finishing', 'AdmFinishingAPI@getFinishing');
Route::get('/finishingchange/{id}', 'AdmFinishingAPI@getDetailFinishing');
Route::get('/file/maxfilesize', 'ImageAPI@getMaxFilesize');

Route::post('/commit/cartpreview/{id}/accept', 'CartpreviewAPI@acceptfile');
Route::post('/commit/cartpreview/{id}/reject', 'CartpreviewAPI@rejectfile');
Route::post('/commit/salesdetail/{id}', 'SalesdetailAPI@commit');
Route::post('/commit/salesdetail/{id}/undo', 'SalesdetailAPI@release');

Route::post('/customer/{id}/getsession', 'CustomerAPI@getsession');
Route::post('/customer/{id}/makesession', 'CustomerAPI@makesession');
Route::get('/data/customers/name', 'CustomerAPI@apiGetName');

Route::get('/customer/{id}/sales', 'CustomerAPI@apiGetSalesByCustID');
Route::get('/cities', 'CityAPI@getAll');
Route::get('/banks',	'BankAPI@getAll');

Route::get("/jobsubtypes/getactive", "JobsubtypeAPI@getActive");
Route::get("/jobsubtypes/getall", "JobsubtypeAPI@getAll");

//user signup
Route::post('/register', 'CustomerAPI@store');
Route::post('/resendverif', 'CustomerAPI@resend');
//

Route::get('/papersizes', 'PaperSizeAPI@all');
Route::get("/sizes", "SizesAPI@getall");
Route::get('/papers/OF', 'PaperAPI@showFlyer');
Route::get('/papers', 'PaperAPI@getAll');
Route::get('/custaccs/{custid}', 'CustomeraccountAPI@getBycustID');

Route::get('/custadds/{custid}', 'CustomeraddressAPI@bycustid');
Route::get('/custadds', 'CustomeraddressAPI@all');

//Route::post("cekharga", 'Calculation@calcPrice');

//LOGIN ONLY
Route::post('/notifications/employee/{id}/count', 'NotificationAPI@employeeall');
Route::post('/notifications/customer/{id}/count', 'NotificationAPI@customerall');
Route::post('/notifications/all/count', 'NotificationAPI@all');

//EMPLOYEE ONLY
Route::post('/admin/compaccs/mandiri/refresh', 'AdmCompanyaccountsAPI@mutasi_mandiri');
Route::post('/admin/compaccs/{accid}/bca/refresh', 'AdmCompanyaccountsAPI@mutasi_bca');
Route::get('/admin/compaccs/{accid}/bca/read', 'AdmCompanyaccountsAPI@read_bca');

//PROFILE
Route::post('/profile/delete/{id}', "ProfileAPI@apiDeleteAddress");
Route::post('/profile/deletecompany/{id}', "ProfileAPI@apiDeleteAddressCompany");
Route::post('/profile/strcompanyaddr/{custid}', "CompanyaddressAPI@store");


Route::get('/io/carts/all', 'AdmCartAPI@getAll');
//Route::get('/io/carts/pending', 'AdmCartAPI@getCartOnly');
//Route::get('/io/sales/all', 'AdmAllSalesAPI@getAll');
//Route::get('/customers/all', 'AdmCustomerAPI@getAll');
Route::post('/io/login', 'MobileappsAPI@login');
//Route::post('/io/logout', 'MobileappsAPI@logout');
Route::post('/io/select/{value}', 'MobileappsAPI@select');
Route::post('/io/update/{value}', 'MobileappsAPI@update');
Route::post('/io/insert/{value}', 'MobileappsAPI@insert');





//## GANTI ISI DATABASE ##
Route::post('/admin/changetheworld/{tablename}', 'AdmChangetheworldAPI@database');