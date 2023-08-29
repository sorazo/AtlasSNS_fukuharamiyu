@extends('layouts.login')

@section('content')
<div>
  <div>
    <form action="/research" method="post">
      @csrf
      <input type="text" name="keyword" class="" placeholder="ユーザー名">
      <button type="submit" class=""><img src="{{asset('images/search.png')}}"></button>
    </form>
  </div>
  <div>
    <table class="table">
    @foreach($users as $user)
    <tr>
      <td><img src="{{asset('images/icon1.png')}}"></td>
      <td>{{ $user->username}}</td>
      <td>
        <!-- ifの条件文はUser.phpに記入 -->
        <!-- もし、私（auth()->user()）がこの人（$user->id）をフォローしていれば（isFollowing） -->
        <!-- テーブル内で関係性を引っ張ってくるだけだから、モデルUser.phpに記述するだけでよい！スマート -->
      @if(auth()->user()->isFollowing($user->id))
      <!-- フォロー解除ボタンを押す -->
      <a href="{{ route('unfollow',['userId'=>$user->id]) }}" class="btn unfollow_btn">フォロー解除</a>
      @else
      <!-- もし、私がこの人をフォローしていなければ、フォローするボタンを表示する -->
      <a href="{{ route('follow',['userId'=>$user->id]) }}" class="btn follow_btn">フォローする</a>
      @endif
      </td>
    </tr>
    @endforeach
    </table>

  </div>
</div>


@endsection
