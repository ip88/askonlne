<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Ask;

class AdminController extends Controller
{
    public function __construct()
    {
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
            Ask::find($id)->update([
                'answer'=>$inputs['answers'][$key],
            ]);
        }

        return redirect(\URL::action('AdminController@getIndex'));
    }
}
