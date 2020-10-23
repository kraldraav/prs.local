<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PrinterController extends Controller
{
    //
    public function index(){
        $printers = App\Printer::all();
        return view('printers.index', compact('printers'));
    }
    
    public function add(){
        return view('printers.add');
    }
    
    public function create(Request $request){
         $this->validate($request, [
            'printer_name' => 'required|unique:printers']);
         
         $printer = new App\Printer;
         $printer->printer_name = Input::get('printer_name');
         $printer->save();
         
         return redirect('/printers');
    }
    
    public function edit($id){
        $printer = App\Printer::where('id', $id)->first();
        return view('printers.edit', compact('printer'));
    }
    
    public function save(Request $request){
        $this->validate($request, [
            'printer_name' => 'required']);
        
        $printer = App\Printer::where('id', Input::get('id'))->first();
        $printer->printer_name = Input::get('printer_name');
        $printer->save();
        
        return redirect('/printers');
    }
}
