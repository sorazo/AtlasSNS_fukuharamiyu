<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){

        $users = User::get();

        return view('users.search',['users'=>$users]);
    }

    public function research(Request $request){
        $keyword=$request->input('keyword');

        if(!empty($keyword)){

            $users=User::where('username','like','%'.$keyword.'%')->get();

        }else{
            $users=User::all();
        }

        return view('users.search',['users'=>$users]);
    }
}
