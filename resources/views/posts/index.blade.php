@extends('layouts.login')

@section('content')

  <form action="/save" method="post">
    <div class="post">
    @csrf
    <p class="icon"><img src="{{ asset('storage/storage/' . Auth::user()->images) }}"></p>
    <!-- Auth::user->usernameだと、名前の取得になるため、名前が同じ人とかいたらどっちを出せばいいのかわからなくなる。だから、idを取らないといけない。 -->
    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
    <textarea class="textarea" name="post" placeholder="投稿内容を入力してください。"></textarea>
    <button type="submit" class="jet"><img src="images/post.png"></button>
    </div>
  </form>

@foreach ($datas as $data)
<div class="post-card">
  <ul>
    <li class="post-block">
      <figure class="icon"><img src="{{ asset('storage/storage/' . $data->user->images) }}"></figure>
      <div class="post-box">
        <div class="post-name">
          <div >{{ $data->user->username }}</div>
          <div>{{ ($data->created_at)->format('Y-m-d H:i') }}</div>
        </div>
        <div class="post-font">{!! nl2br($data->post) !!}</div>
        <!-- 編集・削除ログインユーザーのみつくようにする -->
        <!-- https://qiita.com/mumucochimu/items/4e7a93f7fef6bf651f49 -->
        @if(Auth::user()->id == $data->user_id)
        <p class="content">
          <a class="js-modal-open" href="" post="{{ $data->post }}" post_id="{{ $data->id }}"><img src="images/edit.png"></a>
          <a class="delete" href="/post/{{$data->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"></a>
        </p>
        @endif
      </div>
    </li>
  </ul>
</div>


<!-- JSからモーダルに呼び出される側、edit-modalがmodalの本体 editModal-(投稿ID)で投稿とモーダル画面を紐付けをしている -->
<!-- https://course.lull-inc.co.jp/curriculum/7823/ -->
<!-- https://qiita.com/tommy0218/items/3e6ceb09c01f7c991dd5 -->
<!-- https://teratail.com/questions/297372更新仕方 -->
    <div class="modal js-modal">
      <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            <form method="post" action="{{ route('modal',['id'=>$data->id])}}">
                <textarea name="post" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                     <!-- 送信ボタン -->
                     <div class="confirm">
                    <input type="image" name="btn_confirm" src="images/edit.png"  alt="更新" value="更新" width="50" height="50">
                    </div>
                    @method('PUT')
                    {{ csrf_field() }}
            </form>
            <a class="js-modal-close" href="/top"></a>
        </div>
    </div>
@endforeach


@endsection
