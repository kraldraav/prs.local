<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EventsController extends Controller {

    public function index() {
        $events = App\Event::all();
        return view('events.index', compact('events'));
    }
    
    public function report(){
        return view('events.report');
    }
    
    public function generateReport(Request $request){
        
        $datetime = Input::get('sdate_input');
        
        $this->validate($request, [
            'sdate_input' => 'date|date_format:Y-m-d H:i:s'
        ]);
        
        if($datetime == NULL or $datetime == ''){
            return back()->withErrors(['Введите значение в поле "Начало периода"!']);
        }
        
        $events = DB::connection('mysql')->select("CALL GetUsedCartridges('".$datetime."')");
        
        return view('events.report', compact('events', 'datetime'));
        //return response()->json(['datetime' => $datetime]);
    }

    public function add() {
        //удаляет файлы из каталога (для экономии места)
        $files = glob('docs/*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }

        $departs = \App\Depart::all();
        $printers = App\Printer::all();

        return view('events.add', compact('departs', 'printers'));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'Depart_id' => 'required|not_in:1',
            'Printer_id' => 'required|not_in:1',
            'Cartridge_id' => 'required|not_in:0',
            'Room_numb' => 'max:20'
        ]);

        $event = new App\Event();
        $event->depart_id = Input::get('Depart_id');
        $event->room_numb = Input::get('Room_numb');
        $event->printer_id = Input::get('Printer_id');
        $event->cartridge_id = Input::get('Cartridge_id');
        $event->user_id = Auth::id();
        $event->save();

        $depart = \App\Depart::where('id', $event->depart_id)->first();
        $printer = App\Printer::where('id', $event->printer_id)->first();
        $cartridge = \App\Cartridge::where('id', $event->cartridge_id)->first();
        $user = \App\User::where('id', Auth::id())->first();

        if ($cartridge->count > 0) {
            $cartridge->count = $cartridge->count - 1;
            $cartridge->save();

            $htmlTemplate = $this->findandreplace('Template_request.html', [
                '${Depart_name}' => $depart->depart_name,
                '${Room_numb}' => $event->room_numb,
                '${Printer_name}' => $printer->printer_name,
                '${Cartridge_name}' => $cartridge->cartridge_name,
                '${Fio_engineer}' => $user->name,
                '${Date_curr}' => date("Y-m-d H:i"),
            ]);

            $namefile = 'docs/request_' . date("Y_m_d_His") . '.html';
            file_put_contents($namefile, $htmlTemplate);
            //$this->CheckThresholdAndSendAlert();
            return redirect('/')->with('filename', $namefile);
            
        } else {
            return redirect('/');
        }
    }

    public function reprint($id) {
        $event = App\Event::where('id', $id)->first();
        $depart = \App\Depart::where('id', $event->depart_id)->first();
        $printer = App\Printer::where('id', $event->printer_id)->first();
        $cartridge = \App\Cartridge::where('id', $event->cartridge_id)->first();
        $user = \App\User::where('id', $event->user_id)->first();

        $htmlTemplate = $this->findandreplace('Template_request.html', [
            '${Depart_name}' => $depart->depart_name,
            '${Room_numb}' => $event->room_numb,
            '${Printer_name}' => $printer->printer_name,
            '${Cartridge_name}' => $cartridge->cartridge_name,
            '${Fio_engineer}' => $user->name,
            '${Date_curr}' => $event->created_at->format('Y-m-d H:i:s'),
        ]);

        $namefile = 'docs/request_' . date("Y_m_d_His") . '.html';
        file_put_contents($namefile, $htmlTemplate);

        Session::flash('download.in.the.next.request', $namefile);

        return redirect('/');
    }

    private function CheckThresholdAndSendAlert() {
        $cartridges = DB::table('cartridges')->whereColumn('count', '<', 'threshold')->get();

        Mail::send('emails.alert', compact('cartridges'), function ($message) {
            $message->subject('Внимание! Требуется заказать расходные материалы');
            $message->from('prs_system@hotel-vega.ru', 'Система учета картриджей');
            $message->to('shilin@hotel-vega.ru');
            $message->attach(public_path('/') . 'Template_Alert_html_b4ef34cf.jpg', [
                'as' => 'Template_Alert_html_b4ef34cf.jpg',
                'mime' => 'image/jpeg']);
            $message->attach(public_path('/') . 'Template_Alert_html_8faf1b09.jpg', [
                'as' => 'Template_Alert_html_8faf1b09.jpg',
                'mime' => 'image/jpeg']);
        });
    }

    private function findandreplace($filename, $array_data) {
        $file = file_get_contents($filename);

        $file = strtr($file, $array_data);
        return $file;
    }

    public function getCartridges($p_id) {
        $cartridges = DB::table('cartridges')
                        ->leftJoin('cartdependences', 'cartdependences.cartridge_id', '=', 'cartridges.id')
                        ->select('cartridges.cartridge_name', 'cartridges.id')
                        ->where('cartdependences.printer_id', '=', $p_id)->pluck("cartridge_name", "id");
        //DB::raw("CONCAT(cartridges.cartridge_name, ' - ' , cartridges.count, 'шт.') as full_name")
        return json_encode($cartridges);
    }

    public function getDescCart($c_id) {
        $desc = DB::table('cartridges')->where('cartridges.id', '=', $c_id)->get();

        //var_dump(json_encode($desc));
        return response()->json($desc);
    }

}
