@extends('layouts.login')

@section('content')
<div class="sab">
  <div class="post">
    <div class="search">
        <form action="/research" method="post" class="sea">
          @csrf
          <input type="text" name="keyword" class="ward" placeholder="ユーザー名">
          <button type="submit" class="eye"><img src="{{asset('images/search.png')}}"></button>
        </form>
      @if(isset($keyword))
      <p class="key">検索ワード：{{$keyword}}</p>
      @endif
    </div>
  </div>
</div>
  <div class="post-card">
    <table class="table-block">
    @foreach($users as $user)
    <!-- テーブルに登録されているユーザーとログインしているユーザーが不一致のユーザー(要するに自分以外)の表示 -->
    @if($user->id !== Auth::user()->id)
    <tr class="table-box">
      <td class="icon table-image"><img src="{{ asset('storage/storage/' . $user->images) }}"></td>
      <td class="table-name">{{ $user->username}}</td>
      <td>
        <!-- ifの条件文はUser.phpに記入 -->
        <!-- もし、私（auth()->user()）がこの人（$user->id）をフォローしていれば（isFollowing） -->
        <!-- テーブル内で関係性を引っ張ってくるだけだから、モデルUser.phpに記述するだけでよい！スマート -->
      @if(auth()->user()->isFollowing($user->id))
      <!-- フォロー解除ボタンを押す -->
      <p class="follow"><a href="{{ route('unfollow',['userId'=>$user->id]) }}" class="btn btn-danger btn-lg">フォロー解除</a></p>
      @else
      <!-- もし、私がこの人をフォローしていなければ、フォローするボタンを表示する -->
      <p class="follows"><a href="{{ route('follow',['userId'=>$user->id]) }}" class="btn btn-primary btn-lg">フォローする</a></p>
      @endif
      </td>
    </tr>
    @endif
    @endforeach
    </table>

  </div>


@endsection
