<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password','images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // https://qiita.com/Ryo9597/items/11de8b8c734122923f45
    public function posts(){
        return $this->hasMany("App/Post");
    }

    // 私（ログインユーザー）がフォローしているユーザー
    //  belongsToMany('関係するモデル', '中間テーブルのテーブル名', '中間テーブル内で対応しているID名', '関係するモデルで対応しているID名');
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    // 私をフォローしているユーザー
    public function follower()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }

    // ifの条件文の$userの指定
    // $user_id はフォローしてる人を指している
    // follows()はリレーションで定義した名前
    public function isFollowing(Int $user_id){

        return (bool) $this->follows()->where('followed_id',$user_id)->first();
    }

}
