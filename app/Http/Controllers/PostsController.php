<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostsController extends Controller
{
    //
        // 「フォローしているユーザー」+「自分自身」の投稿を取得
    // https://qiita.com/mitsu-0720/items/68e52e4b56eb749a5283
    public function index(){

        // 並び順(orderBy)を投稿日(created_at)の降順(desc)にして全て取得(get)
         $datas= Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->orWhere('user_id', Auth::user()->id)->latest()->get();


        return view('posts.index')->with(['datas'=>$datas]);
    }

    // 新規投稿の登録
    // https://nebikatsu.com/7808.html/
    // https://qiita.com/Ryo9597/items/11de8b8c734122923f45
    // https://poppotennis.com/posts/laravel-post#%E6%8E%B2%E7%A4%BA%E6%9D%BF%E3%81%AE%E6%8A%95%E7%A8%BF%E6%A9%9F%E8%83%BD%E3%82%92%E5%AE%8C%E6%88%90%E3%81%95%E3%81%9B%E3%82%8B
    public function save(Request $request)
    {
        // dd($request);

        $request ->validate([
            'post'=>'required|min:1|max:150',
        ]);

        $post=new Post;
        $post->user_id =$request->user_id;
        $post->post =$request->post;
        $post->save();

        return redirect('/top');

    }

    // 投稿の更新処理
    public function modal(Request $request){
        $id = $request->input('id');
        $post = $request->input('post');
        Post::query()
        ->where('id',$id)
        ->update(
            ['post' => $post]
        );

        return redirect('/top');
    }

    // 削除
    public function delete($id){
        Post::where('id',$id)->delete();
        return redirect('/top');
    }

}
