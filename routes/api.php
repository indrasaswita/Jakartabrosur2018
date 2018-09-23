<?php

use Illuminate\Http\Request;


Route::get('/jobsubtype/{pages}', 'JobsubtypeAPI@showbylink');
Route::get('/admin/papershop', 'VendorAPI@papershop');

Route::post('/commit/cartpreview/{id}/accept', 'CartpreviewAPI@acceptfile');
Route::post('/commit/cartpreview/{id}/reject', 'CartpreviewAPI@rejectfile');
Route::post('/commit/cartpreview/{id}/undo', 'CartpreviewAPI@undofile');
Route::post('/commit/salesdetail/{id}', 'SalesdetailAPI@commit');
Route::post('/commit/salesdetail/{id}/undo', 'SalesdetailAPI@release');

Route::post('/customer/{id}/getsession', 'CustomerAPI@getsession');
Route::post('/customer/{id}/makesession', 'CustomerAPI@makesession');
Route::get('/data/customers/name', 'CustomerAPI@apiGetName');

Route::get('/customer/{id}/sales', 'CustomerAPI@apiGetSalesByCustID');

//LOGIN ONLY
Route::get('/notifications/employee/{id}/count', 'NotificationAPI@employeeall');
Route::post('/notifications/customer/{id}/count', 'NotificationAPI@customerall');
Route::post('/notifications/all/count', 'NotificationAPI@all');

//EMPLOYEE ONLY
Route::post('/admin/cartpreview/{id}/delete', 'AdmCartpreviewAPI@deleteFile');
Route::post('/admin/cartpreview/{id}/delete', 'AdmCartpreviewAPI@deleteFile');