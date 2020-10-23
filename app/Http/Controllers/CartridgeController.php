<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartridgeController extends Controller {

    //
    public function index() {

        $cartridges = \App\Cartridge::all();
        //$cartridges = DB::table('cartridges')->whereColumn('count', '<=', 'threshold')->get();
        return view('cartridges.index', compact('cartridges'));
    }

    public function add() {
        return view('cartridges.add');
    }

    public function create(Request $request) {
        $this->validate($request, [
            'cartridge_name' => 'required|unique:cartridges',
            'Desc' => 'required',
            'Count' => 'required',
            'Threshold' => 'required'
        ]);
        
        $cart = new \App\Cartridge;
        $cart->cartridge_name = Input::get('cartridge_name');
        $cart->desc = Input::get('Desc');
        $cart->count = Input::get('Count');
        $cart->threshold = Input::get('Threshold');
        $cart->save();
        
        return redirect('/cartridges');
    }
    
    public function edit($id){
        
        $cartridge = \App\Cartridge::where('id', $id)->first();
        return view('cartridges.edit', compact('cartridge'));
    }
    
    public function save(Request $request){
        $this->validate($request, [
            'cartridge_name' => 'required',
            'Desc' => 'required',
            'Count' => 'required',
            'Threshold' => 'required'
        ]);
        
        $cart = \App\Cartridge::where('id', Input::get('id'))->first();
        $cart->cartridge_name = Input::get('cartridge_name');
        $cart->desc = Input::get('Desc');
        $cart->count = Input::get('Count');
        $cart->threshold = Input::get('Threshold');
        $cart->save();
        
        return redirect('/cartridges');
    }

}
