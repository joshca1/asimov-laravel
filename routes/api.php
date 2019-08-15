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

$api_version_prefix = 'Api\\' . config('api.API_VERSION') . '\\';



Route::get('bookings', $api_version_prefix . 'BookingController@showAllBookings');


Route::get('bookings/{date}', $api_version_prefix . 'BookingController@listOfBookingsOnDate');


Route::post('bookings', $api_version_prefix . 'BookingController@storeNewBooking');


Route::put('bookings', $api_version_prefix . 'BookingController@store');

Route::delete('bookings', $api_version_prefix . 'BookingController@deleteBooking');
