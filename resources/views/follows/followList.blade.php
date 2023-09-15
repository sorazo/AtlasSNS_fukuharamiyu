@extends('layouts.login')

@section('content')
<div  class="post">
  <h2 class="title">Follow List</h2>
  <div class="icon-list">
  @foreach($follows as $follow)
  <a class="icon" href="{{ route('profile',['id'=>$follow->id] )}}"> <img src="{{ asset('storage/storage/' . $follow->images) }}"></a>
  @endforeach
  </div>
</div>

@foreach($followlists as $followlist)
<div class="post-card">
  <ul>
    <li class="post-block">
      <a class="icon" href="{{ route('profile',['id'=>$followlist->user->id] )}}"><img src="{{ asset('storage/storage/' . $followlist->user->images) }}"></a>
      <div class="post-box">
        <div class="post-name">
          <div >{{ $followlist->user->username }}</div>
          <div>{{ $followlist->created_at }}</div>
        </div>
        <div class="post-font">{!! nl2br($followlist->post) !!}</div>
      </div>
    </li>
  </ul>
</div>
@endforeach

@endsection
