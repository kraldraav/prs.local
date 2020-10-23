<?php

namespace App\Http\Controllers;


use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpseclib\Net;


class EmailController extends Controller {

    public function index() {

        $emails = DB::connection('email')->select('SELECT mailbox.username as address, mailbox.active, mailbox.`name` as fio, mailbox.quota, alias.goto as redirect, ROUND((used_quota.bytes/1024)/1024) as used FROM mailbox
                                                    LEFT JOIN alias ON alias.address = mailbox.username
                                                    LEFT JOIN used_quota ON used_quota.username = mailbox.username');

        return view('email.index', compact('emails'));
    }

    public function changeRedirect($email) {

        $data = DB::connection('email')->table('alias')->where('address', $email)->first();

        return view('email.changeRedirect', compact('data'));
    }

    public function changeRedirectAction(Request $request) {

        $goto = Input::get('AliasesTxtArea');
        $address = Input::get('address');

        if (empty(trim($goto))) {
            return back()->withErrors(['Поле редирект не может быть пустым, по-умолчанию оно содержит родительский ящик!']); //Обработка ошибки 
        }

        $emails = explode(',', $goto);
        $notExist = [];
        foreach ($emails as $email) {
            $query = DB::connection('email')->table('alias')->select('address')->where('address', $email)->first();
            if ($query == NULL) {
                array_push($notExist, $email);
            }
        }

        if ($notExist != NULL) {
            return back()->withErrors(['Ошибка! Почтовых ящиков: ' . json_encode($notExist) . ' не существует!!! Либо формат неверен!']); //Обработка ошибки
        }



        DB::connection('email')->table('alias')->where('address', $address)->update(['goto' => $goto]);

        $success = 'Изменения успешно внесены!';

        $data = DB::connection('email')->table('alias')->where('address', $address)->first();
        return response()->view('email.changeRedirect', compact('data', 'success'));
    }

    public function changeQuota($email) {
        
    }

    public function clearEmail($email) {
        //include dirname(__FILE__).'/../../../vendor/phpseclib/Net/SSH2.php';
        $ssh = new \phpseclib\Net\SSH2('192.168.11.77');
        if (!$ssh->login('sysadmin', '#rjynhjkth')) {
            return response()->json(['Error' => 'Не удалось подключиться к серверу']);
        }

        $result = $ssh->exec('./mail_emp.sh ' . $email);
        return response()->json(['result' => $result ]);
    }

    public function save(Request $request) {
        
    }

}
