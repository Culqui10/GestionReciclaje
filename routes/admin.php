<?php

use App\Http\Controllers\Admin\ActionsController;
use App\Http\Controllers\Admin\ActivitiesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandmodelsController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\DriversController;
use App\Http\Controllers\Admin\HorariesController;
use App\Http\Controllers\Admin\LicensetypesController;
use App\Http\Controllers\Admin\OccupantsController;
use App\Http\Controllers\Admin\ProgrammingsController;
use App\Http\Controllers\Admin\RoutesController;
use App\Http\Controllers\Admin\RouteZonesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UsertypesController;
use App\Http\Controllers\Admin\UserypesController;
use App\Http\Controllers\Admin\VehiclecolorsController;
use App\Http\Controllers\Admin\VehicleOccupantsController;
use App\Http\Controllers\Admin\VehiclesController;
use App\Http\Controllers\Admin\VehicletypesController;
use App\Http\Controllers\Admin\ZonecoordsController;
use App\Http\Controllers\Admin\ZonesController;
use App\Models\Brandmodel;
use App\Models\Vechicletype;
use Illuminate\Support\Facades\Route;
 

Route::resource('/brand', BrandsController::class)->names('admin.brands');
Route::resource('/model', BrandmodelsController::class)->names('admin.models');
Route::resource('/type', VehicletypesController::class)->names('admin.types');
Route::resource('/color', VehiclecolorsController::class)->names('admin.colors');
Route::resource('/vehicle', VehiclesController::class)->names('admin.vehicles');
Route::resource('/usertypes', UsertypesController::class)->names('admin.Usertypes'); 
Route::resource('/users', UsersController::class)->names('admin.users');
Route::resource('/zones', ZonesController::class)->names('admin.zones');
Route::resource('/zonecoords', ZonecoordsController::class)->names('admin.zonecoords');
Route::resource('/occupants', VehicleOccupantsController::class)->names('admin.vehicleoccupants');
Route::resource('/routezones', RouteZonesController::class)->names('admin.routezones');
Route::resource('/occupant', OccupantsController::class)->names('admin.occupant');
Route::resource('/routes', RoutesController::class)->names('admin.routes');
Route::resource('/rou', RoutesController::class)->names('admin.routes');
Route::resource('/programming', ProgrammingsController::class)->names('admin.programming');
Route::resource('/activitie', ActivitiesController::class)->names('admin.activities');
Route::resource('/horarie', HorariesController::class)->names('admin.horaries');
Route::resource('/action', ActionsController::class)->names('admin.actions');

Route::get('modelsbybrand/{id}', [BrandmodelsController::class, 'modelsbybrand'])->name('admin.modelsbybrand');
Route::get('typebyuser/{id}', [VehicleOccupantsController::class, 'typebyuser'])->name('admin.typebyuser');
Route::get('searchbydni/{id}', [OccupantsController::class, 'searchbydni'])->name('admin.searchbydni');
Route::post('occupants/confirm-assignment', [OccupantsController::class, 'confirmAssignment'])->name('admin.occupants.confirm-assignment');
Route::get('searchprogramming', [ProgrammingsController::class, 'searchprogramming'])->name('admin.searchprogramming');


//Route::resource('/license', LicensetypesController::class)->names('admin.licenses');

?>