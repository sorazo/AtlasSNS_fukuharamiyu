<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
     public function unfollow($userId)
    {
        // フォローしているか
        // $followerは、User.phpを通して、usersテーブルを変数化
        // $is_followingで、userテーブルのログインユーザーが、followed_idであることを指している
        $follower = auth()->user();
        $is_following = $follower->isFollowing($userId);

        // フォローしていれば下記のフォロー解除を実行する
        if ($is_following) {

            $loggedInUserId = auth()->user()->id;
            Follow::where([
                ['followed_id', '=', $userId],
                ['following_id', '=', $loggedInUserId],
            ])
                ->delete();
        }
        return back();
    }

    public function follow($userId)
    {
        // フォローしているか
        $follower = auth()->user();
        $is_following = $follower->isFollowing($userId);

        // フォローしていなかったら下記のフォロー処理を実行
        if (!$is_following) {
            // 自分のユーザーIDを取得
            $loggedInUserId = auth()->user()->id;
            // フォローしたい人のユーザーIDを元にユーザーを取得
            $followedUser = User::find($userId);
            $followedUserId = $followedUser->id;

            // フォローデータをデータベースに登録
            Follow::create([
                'following_id' => $loggedInUserId,
                'followed_id' => $followedUserId,
            ]);
            return back(); // フォロー後に元のページにリダイレクト
        }
    }


    public function followList(){

        // $followには、ログイン中のユーザーをフォローしているユーザーの一覧が含まれる
        $follows=User::query()->whereIn('id', Auth::user()->follows()->pluck('followed_id'))->get();

        $followlists=Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();

        return view('follows.followList',['followlists'=>$followlists,'follows'=>$follows]);
    }
    public function followerList(){

        // $followersには、ログイン中のユーザーをフォローしているユーザーの一覧が含まれる
        $followers=User::query()->whereIn('id', Auth::user()->follower()->pluck('following_id'))->get();


        $followerlists=Post::query()->whereIn('user_id', Auth::user()->follower()->pluck('following_id'))->latest()->get();

        return view('follows.followerList',['followerlists'=>$followerlists,'followers'=>$followers]);
    }
}
