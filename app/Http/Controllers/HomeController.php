<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Booking;
use Bouncer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->isAn('admin'))
            return redirect('/admin/home');
        else{
            $this->authorize('viewBooking', Booking::class);

            $requests = Booking::where('user_id', Auth::user()->id)->paginate(10);
            
            return view('/home')->withRequests($requests);
        }
    }
}
