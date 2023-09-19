@extends('layouts.login')

@section('content')
<div class="sab">
<div class="post">
  <h2 class="title">Follower List</h2>
  <div class="icon-list">
  @foreach($followers as $follower)
    <a class="icon" href="{{ route('profile',['id'=>$follower->id] )}}"> <img src="{{ asset('storage/storage/' . $follower->images) }}"></a>
  @endforeach
  </div>
</div>
</div>
@foreach($followerlists as $followerlist)
<div class="post-card">
  <ul>
    <li class="post-block">
      <a class="icon" href="{{ route('profile',['id'=>$followerlist->user->id] )}}"><img src="{{ asset('storage/storage/' . $followerlist->user->images) }}"></a>
      <div class="post-box">
        <div class="post-name">
          <div >{{ $followerlist->user->username }}</div>
          <div>{{ $followerlist->created_at }}</div>
        </div>
        <div class="post-font">{!! nl2br($followerlist->post) !!}</div>
      </div>
    </li>
  </ul>
</div>
@endforeach

@endsection
