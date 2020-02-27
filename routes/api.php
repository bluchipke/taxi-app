<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// header('Access-Control-Allow-Origin:  http://localhost/');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin, X-Request-With');
// header('Access-Control-Allow-Methods:  GET, POST, PUT, DELETE, OPTIONS');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    // return $request->user();
});
Route::get('findVehicle', 'API\VehicleController@search');
Route::get('structures', 'API\AdministrationController@structures');
Route::post('structures/store', 'API\AdministrationController@strStore');
Route::get('structures/show/{id}', 'API\AdministrationController@strShow');
Route::put('structures/edit/{id}', 'API\AdministrationController@strEdit');
Route::get('schedules/driver/{id}', 'API\ScheduleController@driver');
Route::put('schedules/close/{id}', 'API\ScheduleController@closeSchedule');
Route::get('schedules/list', 'API\ScheduleController@scheduleList');
Route::get('schedules/closed', 'API\ScheduleController@closedSchedules');
Route::get('schedules/singlelist/{id}', 'API\ScheduleController@scheduleDetails');
Route::get('vehicles/open', 'API\VehicleController@openVehicles');
Route::put('trips/complete/{id}', 'API\TripsController@completeTrip');
Route::put('trips/close/{id}', 'API\TripsController@closeTrip');
Route::put('trips/reopen/{id}', 'API\TripsController@reopenTrip');
Route::get('driver/{id}/trips', 'API\DriverController@trips');
Route::get('driver/{id}/collections', 'API\DriverController@collections');
Route::get('driver/{id}/commissions', 'API\DriverController@commissions');
Route::get('driver/{id}/schedules', 'API\DriverController@schedules');
Route::get('driver/schedule/{id}', 'API\DriverController@schedule');
Route::get('driver/{id}/vehicles', 'API\DriverController@vehicles');
Route::get('driver/trips', 'API\DriverController@currentTrips');
Route::get('sortCollections', 'API\DriverController@search');
Route::get('clients/list', 'API\OrganizationController@clientList');
Route::get('vehicles/list', 'API\OrganizationController@clientList');
Route::get('vehicle/schedule', 'API\VehicleController@currentVehicle');
Route::post('reports/drivers/commissions', 'API\ReportsController@driverCommissions');
Route::get('reports/drivers/commissions/summary/{id}/{date1}/{date2}', 'API\ReportsController@driverCommissionsSummary');
Route::get('reports/clients/{id}/{date1}/{date2}', 'API\ReportsController@clientReports');
Route::get('reports/drivers/worksheet/{id}', 'API\ReportsController@worksheetDetails');
Route::get('reports/invoice/{id}', 'API\ReportsController@invoiceReports');
Route::get('reports/invoices/{id}/{date1}/{date2}', 'API\ReportsController@sortableInvoice');
Route::get('reports/invoices/client', 'API\ReportsController@clientInvoices');
Route::apiResource('user', 'API\UserController');
Route::apiResource('roles', 'API\RoleController');
Route::apiResource('trips', 'API\TripsController');
Route::apiResource('drivers', 'API\DriverController');
Route::apiResource('invoices', 'API\InvoiceController');
Route::apiResource('vehicles', 'API\VehicleController');
Route::apiResource('permissions', 'API\PermissionController');
Route::apiResource('administrations', 'API\AdministrationController');
Route::apiResource('schedules', 'API\ScheduleController');
Route::apiResource('organizations', 'API\OrganizationController');