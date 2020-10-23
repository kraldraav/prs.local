<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TroubletypesController extends Controller
{
    //
    public function add(){
        return view('troubletypes.add');
    }
    
    public function create(Request $request) {
        $this->validate($request, [
            'Type_name' => 'required|max:100'
        ]);
        
        $tt = new \App\TroubleType();
        
        $tt->type_name = Input::get('Type_name');
        $tt->save();
        
        return redirect('/lockevents');
    }
}
