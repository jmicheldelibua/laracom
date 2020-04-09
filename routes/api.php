<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Front')->group(function () {
	Route::match(['get'],'products',"ProductController@searchApi");
});
/*
Route::group(["middleware"=>"autenticado"],function(){

	Route::group(["namespace"=>"Seguridad"],function(){

		Route::match(['post','put'],'medico/empleado/{id?}',"RegistroUsuarioController@registrar")->name("medico/empleado");
	});
});

*/
