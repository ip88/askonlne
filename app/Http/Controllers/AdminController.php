<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Ask;
use App\User;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth-route-as-admin');

        $this->user = Auth::user();
        //dd($this->user);
    }

    public function getIndex()
    {

        $data = [
            'asks' => Ask::orderBy('created_at', 'desc')->get(),
        ];

        return view('answering.list', $data);
    }

    public function postAdd(Request $request)
    {
        $inputs = $request->all();

        $id = $inputs['ask_id'];
        $answer = $inputs['answer'];

        $ask = Ask::find($id);

        $ask->update([
            'answer' => $answer,
        ]);

        $text = [
            'text' => 'Вам пришел ответ на Ваш вопрос<br>Не отвечайте на данное сообщение.'
        ];

        Mail::send('email', $text, function ($message) use ($ask) {
            $message->to(User::find($ask->user_id)->email, 'AskOnlineeeee')->subject('AskOnlineeeee оповещение');
        });

        return redirect(\URL::action('AdminController@getIndex'));
    }
}
