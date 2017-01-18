<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Ask;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth-route-as-user');

        $this->user = Auth::user()->id;
      //  dd($this->user);
    }

    public function getIndex(Request $request)
    {
        $data = [
            'asks' => Ask::where('user_id', $this->user)->get(),
        ];

        if($request->ajax())return view('asks.asks_ajax', $data);
        //dd($data);
        return view('asks.list', $data);
    }



    public function getAdd()
    {
        return view('news.add');
    }

    public function postAdd(Request $request)
    {
        $admin = User::find(1);

        $inputs = $request->all();
        $inputs['user_id'] = $this->user;

        Ask::create($inputs);

        Mail::send('email', $inputs['question'], function ($message) use($admin){
            $message->to($admin->email, 'AskOnlineeeee')->subject('AskOnlineeeee оповещение');
        });

        return redirect(\URL::action('UserController@getIndex'));
    }
}
