<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LockeventsController extends Controller {

    public function index() {
        $items = DB::table('lockevents')
                ->leftJoin('users', 'users.id', '=', 'lockevents.user_id')
                ->leftJoin('troubletypes', 'troubletypes.id', '=', 'lockevents.trouble_type_id')
                ->select('lockevents.id', 'lockevents.room_numb', 'troubletypes.type_name', 'lockevents.comment', 'users.name', 'lockevents.created_at')
                ->orderBy('lockevents.created_at', 'desc')
                ->paginate(15);

        return view('lockevents.index', compact('items'));
    }

    public function report() {
        return view('lockevents.report');
    }

    public function generateReport(Request $request) {

        $datetime = Input::get('sdate_input');
        
        $this->validate($request, [
            'sdate_input' => 'date|date_format:Y-m-d H:i:s'
        ]);
        
        $floors = $request->input('floor');

        $like = '(';

        $i = 0;
        $len = count($floors);
        foreach ($floors as $floor) {

            $room_numb = (iconv_strlen($floor) == 1) ? '0'.$floor : $floor;
            
            if ($i == $len - 1) {
                $like .= "room_numb LIKE '".$room_numb."%'";
            }
            else {
                $like .= "room_numb LIKE '".$room_numb."%' OR ";
            }
            $i++;
        }

        $like .= ')';
        
        $query = 'SELECT lockevents.created_at,lockevents.room_numb,troubletypes.type_name,lockevents.`comment` FROM lockevents LEFT JOIN troubletypes ON trouble_type_id = troubletypes.id WHERE lockevents.created_at > "' . $datetime . '" AND '.$like.' ORDER BY room_numb ASC';

        $events = DB::connection('mysql')->select($query);
        
        return view('lockevents.report', compact('events', 'datetime'));
        //return response()->json(['query' => $query]);
    }

    public function add() {
        $trouble_types = \App\TroubleType::all();
        return view('lockevents.add', compact('trouble_types'));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'Room_numb' => 'required|numeric',
            'Trouble_type' => 'required'
        ]);

        $le = new \App\Lockevent();
        $room_numb = Input::get('Room_numb');
        $le->room_numb = (iconv_strlen(Input::get('Room_numb')) == 3) ? '0' . $room_numb : $room_numb;
        $le->trouble_type_id = Input::get('Trouble_type');
        $le->comment = Input::get('Comment');
        $le->user_id = Auth::id();
        $le->save();

        return redirect('/lockevents');
    }

    public function detail($id) {
        $items = DB::table('lockevents')
                ->leftJoin('troubletypes', 'troubletypes.id', '=', 'lockevents.trouble_type_id')
                ->leftJoin('users', 'users.id', '=', 'lockevents.user_id')
                ->select('lockevents.room_numb', 'troubletypes.type_name', 'lockevents.comment', 'users.name', 'lockevents.created_at')
                ->where('lockevents.room_numb', $id)
                ->orderBy('lockevents.updated_at', 'desc')
                ->paginate(15);

        return view('lockevents.detail', compact('items', 'id'));
    }

}
