<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        $events = DB::table('events')
                ->leftJoin('departs', 'departs.id', '=', 'events.depart_id')
                ->leftJoin('printers', 'printers.id', '=', 'events.printer_id')
                ->leftJoin('cartridges', 'cartridges.id', '=', 'events.cartridge_id')
                ->leftJoin('users', 'users.id', '=', 'events.user_id')
                ->select('events.id', 'departs.depart_name', 'events.room_numb', 'printers.printer_name', 'cartridges.cartridge_name', 'users.name', 'events.updated_at')
                ->orderBy('events.updated_at', 'desc')
                ->paginate(15);//->pluck('depart_name', 'printer_name', 'cartridge_name', 'name', 'updated_at');
        
        return view('home', compact('events'));
    }
}
