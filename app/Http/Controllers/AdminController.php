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
            'asks' => Ask::all(),
        ];

        return view('answering.list', $data);
    }

    public function postAdd(Request $request)
    {
        $inputs = $request->all();

        foreach ($inputs['ids'] as $key=>$id) {
            $ask = Ask::find($id);
            $answ = $inputs['answers'][$key];
            $ask->update([
                'answer'=>$answ,
            ]);

            Mail::send('email', $answ, function ($message) use ($ask) {
                $message->to(User::find($ask->user_id)->email, 'AskOnlineeeee')->subject('AskOnlineeeee оповещение');
            });

        }

        return redirect(\URL::action('AdminController@getIndex'));
    }
}
