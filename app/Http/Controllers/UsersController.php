<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use App\Post;
use Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    //
    // https://qiita.com/AkiYanagimoto/items/db718029ccb85580d439
    public function profile($id){

        $user=User::where('id',$id)->first();

        $posts=Post::where('user_id',$user->id)->orderBy('created_at','desc')->get();

        return view('users.profile',(['user'=>$user,'posts'=>$posts]));
    }

    public function update(Request $request){
        $user=Auth::user();
        if($request->isMethod('put')){

            $mail=auth()->user()->id;

        $request ->validate([
             // name属性
                'username' =>'required|min:2|max:12',
                'mail' =>['required','email',Rule::unique('users')->ignore($mail),],
                'password' =>'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|confirmed',
                'password_confirmation' =>'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',
                'bio' =>'max:150',
                'images'=>'file|mimes:jpg,png,gif,svg',
            ]);

        // fileメソッドにはinputタグのname属性を、storeメソッドには、保存したいパス(ディレクトリ)を指定

        $user->username = $request->username;
        $user->mail = $request->mail;
        $user->password = $request->password;

        if($request->bio){
        $user->bio = $request->bio;

        }

        // $password=bcrypt('password');
        // ↑だと、パスワードが何を打っても「password」になってしまう
        $password=bcrypt($request->password);
        $user->password=$password;

        if($request->images ){
            // 画像が送られてきたら実行
            // storeメゾットは、()内何もないと、storage/appに保存される
        $file_name = $request->file('images')->getClientOriginalName();
        $image=$request->file('images')->storeAs('public/storage',$file_name);

        // $userをimages=$imageに変える
        // データベースには名前を入れる。その名前から相対パスを作り、データにある画像の表示ができる。
        // $user->images=basename($image);
        // ↑basebanameで、$imageで勝手に作られた名前を取得してた
        $user->images=$file_name;
        }


        $user->save();

        // $form=$request->all();

        // $image=$request->file('images');

        // $password=bcrypt('password');
        // $user->password=$password;

        // $user->fill($form)->save();

        return back();
        }
        return view('users.profile',['user'=>$user]);
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

        return view('users.search',(['users'=>$users,'keyword'=>$keyword]));
    }
}
