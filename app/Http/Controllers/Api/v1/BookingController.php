<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use App\Http\Resources\BookingResource;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreNewBookingRequest;

class BookingController extends Controller
{
    /**
     * List of all bookings
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllBookings()
    {
        $bookings = Booking::all();
        return new BookingResource($bookings);
    }

    /**
     * method that returns true if
     * the email already booked an hour
     * with the death, to prevent 
     * more than 1 hour in a row
     * otherwise returns false
     * @return boolean
     */
    public function isLastHourBookedBySameEmail($email, $date, $hour)
    {
        return  DB::table('bookings')->where([
            ['email', '=', $email],
            ['booking_date', '=', $date],
            ['booking_hour', '=', $hour - 1]
        ])->first();
    }

    /**
     * method that returns true if
     * the hour is already booked
     * by someone.
     * @return boolean
     */
    public function isTheHourAlreadyBooked($date, $hour)
    {
        return DB::table('bookings')->where([
            ['booking_date', '=', $date],
            ['booking_hour', '=', $hour]
        ])->first();
    }
    /**
     * Store a new Booking into db
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNewBooking(StoreNewBookingRequest $request)
    {

        $validatedData = $request->validated();
        $email = $validatedData['email'];
        $date = $validatedData['date'];
        $hour = $validatedData['hour'];

        $lastHourAlreadyBooked = $this->isLastHourBookedBySameEmail($email, $date, $hour);
        $hourIsAlreadyBooked = $this->isTheHourAlreadyBooked($date, $hour);

        if ($lastHourAlreadyBooked || $hourIsAlreadyBooked) {
            return response()->json([
                'error' => 'That Hour is already booked,' .
                    ' or you are trying to book more than' .
                    ' 1 hour in a row.'
            ], 422);
        }

        $booking = new Booking;
        $booking->email = $email;
        $booking->booking_date = $date;
        $booking->booking_hour = $hour;
        if ($booking->save()) {
            return new BookingResource($booking);
        }
    }

    /**
     *  List of all bookings on a specific date
     *
     * @param  date $date
     * @return \Illuminate\Http\Response
     */
    public function listOfBookingsOnDate(Request $date)
    {
        /**
         * validate that the date passed to this function is valid to store in the database
         * if the date is invalid  
         */
        $validatedData =  $date->validate([
            'date' => 'bail|required|date',
        ]);
        $validatedDate = $validatedData['date'];
        echo $validatedDate;
        $bookings = DB::table('bookings')->where('booking_date', '=', $validatedDate)->orderBy('booking_hour', 'asc')->get();
        return new BookingResource($bookings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Delete an existing Booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function deleteBooking($id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     if ($booking->delete()) {
    //         return new BookingResource($booking);
    //     }
    // }
}
