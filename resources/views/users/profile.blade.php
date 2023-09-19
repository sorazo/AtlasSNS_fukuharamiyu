@extends('layouts.login')

@section('content')

@if($user->id !==Auth::user()->id )

<!-- 他ユーザーのプロフィール -->
<div class="profile">
  <p class="icon"><img src="{{ asset('storage/storage/' . $user->images) }}"></p>
  <table class="another">
      <tr><th>name</th><td>{{ $user->username }}</td></tr>
      <tr><th>bio</th><td>{{ $user->bio }}</td></tr>
  </table>
  @if(auth()->user()->isFollowing($user->id))
      <!-- フォロー解除ボタンを押す -->
      <p class="follow"><a href="{{ route('unfollow',['userId'=>$user->id]) }}" class="btn btn-danger btn-lg">フォロー解除</a></p>
      @else
      <!-- もし、私がこの人をフォローしていなければ、フォローするボタンを表示する -->
      <p class="follow"><a href="{{ route('follow',['userId'=>$user->id]) }}" class="btn btn-primary btn-lg">フォローする</a></p>
      @endif
</div>
  @foreach($posts as $post)
    <div class="post-card">
  <ul>
    <li class="post-block">
      <figure class="icon"><img src="{{ asset('storage/storage/' . $post->user->images) }}"></figure>
      <div class="post-box">
        <div class="post-name">
          <div >{{ $post->user->username }}</div>
          <div>{{ $post->created_at }}</div>
        </div>
        <div class="post-font">{!! nl2br($post->post) !!}</div>
      </div>
    </li>
  </ul>
</div>
  @endforeach

@else
<!-- ログインユーザー -->
<div class="change-block">
  <figure class="icon"><img src="{{ asset('storage/storage/' . Auth::user()->images) }}"></figure>
  <div class="change-box">
    <form action="/profile/edit" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <input type="hidden" name="id" value="{{$user->id}}">

      <div class="change-card">
        <label for="username">user name</label>
        <input class="personal" type="text" id="username" name="username" value="{{ $user->username }}">
      </div>
      <div class="accident">
          @if ($errors->has('username'))
          <tr>
            <th>ERROR</th>
            @foreach($errors->get('username') as $message)
            <td> {{ $message }} </td>
            @endforeach
          </tr>
          @endif
        </div>

      <div class="change-card">
        <label for="mail">mail adress</label>
        <input class="personal" type="email" id="mail" name="mail" value="{{ $user->mail }}">
      </div>
         <div class="accident">
          @if ($errors->has('mail'))
          <tr>
            <th>ERROR</th>
            @foreach($errors->get('mail') as $message)
            <td> {{ $message }} </td>
            @endforeach
          </tr>
          @endif
        </div>

      <div class="change-card">
      <label for="password">password</label>
      <input class="personal" type="password" id="password" name="password" value="">
      </div>
      <div class="accident">
          @if ($errors->has('password'))
          <tr>
            <th>ERROR</th>
            @foreach($errors->get('password') as $message)
            <td> {{ $message }} </td>
            @endforeach
          </tr>
          @endif
        </div>

      <div class="change-card">
      <label for="password_confirmation">password confirm</label>
      <input class="personal" type="password" id="password_confirmation" name="password_confirmation" value="">
      </div>
      <div class="accident">
          @if ($errors->has('password_confirmation'))
          <tr>
            <th>ERROR</th>
            @foreach($errors->get('password_confirmation') as $message)
            <td> {{ $message }} </td>
            @endforeach
          </tr>
          @endif
        </div>

      <div class="change-card">
      <label for="bio">bio</label>
      <input class="personal" type="text" id="bio" name="bio" value="{{ $user->bio }}">
      </div>
            <div class="accident">
          @if ($errors->has('bio'))
          <tr>
            <th>ERROR</th>
            @foreach($errors->get('bio') as $message)
            <td> {{ $message }} </td>
            @endforeach
          </tr>
          @endif
        </div>

      <div class="change-card">
      <label for="images">icon image</label>
      <label class="space ">
      <input  type="file" id="images" name="images" ><p class="select">ファイルを選択</p>
      </label>
      </div>
        <div class="accident">
          @if ($errors->has('images'))
          <tr>
            <th>ERROR</th>
            @foreach($errors->get('images') as $message)
            <td> {{ $message }} </td>
            @endforeach
          </tr>
          @endif
        </div>

      <div class="update">
      <input class="up btn btn-danger" style="width: 200px;" type="submit" value="更新">
      </div>
    </form>
  </div>
</div>

@endif
@endsection
