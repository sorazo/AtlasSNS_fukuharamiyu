@extends('layouts.login')

@section('content')
<div class="">
  <form action="/save" method="post">
    @csrf
    <img src="{{asset('images/icon1.png')}}">
    <!-- Auth::user->usernameだと、名前の取得になるため、名前が同じ人とかいたらどっちを出せばいいのかわからなくなる。だから、idを取らないといけない。 -->
    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
    <textarea name="post" placeholder="投稿内容を入力してください。"></textarea>
    <button type="submit" class=""><img src="images/post.png"></button>
  </form>
</div>

<div class="">
  @foreach ($datas as $data)
  <div class="">
    <img src="{{asset('images/icon1.png')}}">
    <p>{{ $data->user->username }}</p>
    <p>{!! nl2br($data->post) !!}</p>
    <p>{{ $data->created_at }}</p>
    <!-- 編集・削除ログインユーザーのみつくようにする -->
    <!-- https://qiita.com/mumucochimu/items/4e7a93f7fef6bf651f49 -->
    @if(Auth::user()->id == $data->user_id)
    <div class="content">
    <a class="js-modal-open" href="" post="{{ $data->post }}" post_id="{{ $data->id }}"><img src="images/edit.png"></a>
    <a class="delete" href="/post/{{$data->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"></a>
    </div>
    @endif
  </div>
  @endforeach
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
                    <input type="submit" value="更新">
                    @method('PUT')
                    {{ csrf_field() }}
            </form>
            <a class="js-modal-close" href="/top">閉じる</a>
        </div>
    </div>


@endsection
