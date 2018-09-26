<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url('admin'));
});

/*
|
| Reports
|
*/

// Reports => periodic maintenances
Route::get('admin/report/periodic_maintenances','AdminReportController@getMaintenances');
Route::post('admin/report/periodic_maintenances/general','AdminReportController@getMaintenancesGeneral');
Route::post('admin/report/periodic_maintenances/building','AdminReportController@getMaintenancesBuilding');
Route::post('admin/report/periodic_maintenances/room','AdminReportController@getMaintenancesRoom');
Route::post('admin/report/periodic_maintenances/technician','AdminReportController@getMaintenancesTechnician');
Route::post('admin/report/periodic_maintenances/device','AdminReportController@getMaintenancesDevice');
