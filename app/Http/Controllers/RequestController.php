<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Booking;
use Bouncer;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('requestBooking', Booking::class);

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('requestBooking', Booking::class);
        
        $validator = Validator::make($request->all(), [
            'book_from' => 'required',
            'book_to' =>'required',
            'venue_id' => 'required',
            'reason' => 'required'
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }

        $bookFrom = Carbon::createFromFormat('d/m/y h:i A', $request->book_from);
        $bookTo = Carbon::createFromFormat('d/m/y h:i A', $request->book_to);

        $crashRequests = Booking::where(function ($query) use ($bookFrom, $bookTo){
                                $query->where('book_from', '>=', $bookFrom)
                                      ->where('book_from', '<', $bookTo);
                            })
                            ->orWhere(function ($query) use ($bookFrom, $bookTo) {
                                $query->where('book_to', '>', $bookFrom)
                                      ->where('book_to', '<=', $bookTo);
                            })
                            ->orWhere(function ($query) use ($bookFrom, $bookTo) {
                                $query->where('book_from', '<=', $bookFrom)
                                      ->where('book_to', '=>', $bookTo);
                            })
                            ->get();
        
        $crashRequests = $crashRequests->where('venue_id', $request->venue_id);

        if(count($crashRequests) > 0){

            $validator->errors()->add('venue_id', 'Venue not available!');

            return back()->withErrors($validator)->withInput();
        }

        $booking = new Booking;
        $booking->book_from = $bookFrom;
        $booking->book_to = $bookTo;
        $booking->venue_id = $request->venue_id;
        $booking->user_id = Auth::user()->id;
        $booking->status = 'pending';
        $booking->reason = $request->reason;
        $booking->save();

        return redirect('home');
    }

    public function searchVenue(Request $request){

        $this->authorize('requestBooking', Booking::class);

        $validator = $request->validate([
            'book_from' => 'required',
            'book_to' =>'required',
        ]);

        $bookFrom = Carbon::createFromFormat('d/m/y h:i A', $request->book_from);
        $bookTo = Carbon::createFromFormat('d/m/y h:i A', $request->book_to);

        $crashRequests = Request::where('book_from', '>=', $request->book_from)
                            ->where('book_from', '<', $request->book_to)
                            ->orWhere(function ($query) {
                                $query->where('book_to', '>', $request->book_from)
                                      ->where('book_to', '<=', $request->book_to);
                            })
                            ->get();

        foreach($crashRequest as $crashRequest){

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('viewBooking', Booking::class);

        $request = Booking::findOrFail($id);

        return view('show')->withRequest($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('cancelBooking', Booking::class);

        $request = Booking::findOrFail($id);

        $request->delete();

        return redirect()->route('home');
    }
}
