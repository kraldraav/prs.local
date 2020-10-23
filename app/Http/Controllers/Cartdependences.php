<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class Cartdependences extends Controller
{
    public function index(){
        $dependences = DB::table('cartdependences')
                ->leftJoin('printers', 'printers.id', '=', 'cartdependences.printer_id')
                ->leftJoin('cartridges', 'cartridges.id', '=', 'cartdependences.cartridge_id')
                ->select('printers.printer_name', 'cartridges.cartridge_name', 'cartdependences.id')
                ->paginate(15);
        return view('cartdependences.index', compact('dependences'));
    }
    
    public function add(){
        $printers = App\Printer::all();
        $cartridges = \App\Cartridge::all();
        return view('cartdependences.add', compact('printers', 'cartridges'));
    }
    
    public function edit($id){
        $dependences = \App\Cartdependence::where('id', $id)->first();
        $printers = App\Printer::all();
        $cartridges = \App\Cartridge::all();
        return view('cartdependences.edit', compact('dependences','printers', 'cartridges'));
    }
    
    public function save(Request $request) {
        $this->validate($request, [
           'Printer_id' => 'required',
           'Cartridge_id' => 'required'
        ]);
        
        $dep = \App\Cartdependence::where('id', Input::get('id'))->first();
        $dep->printer_id = Input::get('Printer_id');
        $dep->cartridge_id = Input::get('Cartridge_id');
        $dep->save();
        
        return redirect('/dependences');
    }
    
    public function create(Request $request){
        $this->validate($request, [
           'Printer_id' => 'required|not_in:1',
           'Cartridge_id' => 'required|not_in:0'
        ]);
               
        $dep = new App\Cartdependence();
        $dep->printer_id = Input::get('Printer_id');
        $dep->cartridge_id = Input::get('Cartridge_id');
        $dep->save();
       
       return redirect('/dependences');
    }
}
