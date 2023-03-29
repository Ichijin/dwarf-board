@include('common.header')
<div id="contents">
  <div id="main_chat">
    <section id="pagetop">
      <h2 class="title">Comment Room<span>掲示板</span></h2>
      <form action="?" id="home_form">
        @csrf
        @if ($errors->has('comment'))
          <p class="alert">{{ $errors->first('comment') }}</p>
        @endif
        <div class="flex_item">
          <img class="icon1" src="images/{{$img}}" alt="">
          <input type="hidden" name="img" value="{{ $img}}" >
          <table class="ta1 table_chat">
            <tr>
              <th>投稿日時</th>
              <td class="ws">{{$post['created_at']}}</td>
              <input type="hidden" name="created_at" value="{{$post['created_at']}}">
            </tr>
            <tr>
              <th>名前</th>
              <td class="ws">{{$post['name']}}</td>
              <input type="hidden" name="name" value="{{$post['name']}}">
            </tr>
            <tr>
              <th>タイトル</th>
              <td class="ws">{{$post['title']}}</td>
              <input type="hidden" name="title" value="{{$post['title']}}">
            </tr>
            <tr>
              <th>つぶやき</th>
              <td cols="30" rows="10" class="wl">{{$post['post']}}</td>
              <input type="hidden" name="post" value="{{$post['post']}}">
            </tr>
            <tr>
              <th>コメント</th>
              <td cols="30" rows="10" class="wl"><textarea name="comment" cols="30" rows="10" class="wl" value=""></textarea></td>
            </tr>
            <!-- コメントする人のID -->
            <input type="hidden" name="user_id" value="{{ $user['id'] }}" >
            <!-- 投稿のID -->
            <input type="hidden" name="post_id" value="{{ $post['id'] }}" >
          </table>
        </div>
        <div class="c">
          <input class="btn_des1" type="submit" name="commit" value="コメント投稿" formmethod="post" formaction="{{ url('/commit') }}">
          <input class="btn_des1" type="submit" id="back_btn" name='back' value="戻る" formmethod="post" formaction="{{ url('/commit') }}">
        </div>
      </form>

      <div class="comment_item">
        <h2 class="title comment">Comment<img class="comment_img" src="images/comment.png" alt=""></h2>
        @foreach($comments as $comment)
          <form action="?" id="home_form">
            @csrf
            <!-- コメントする人のID -->
            <input type="hidden" name="user_id" value="{{ $user['id'] }}" >
            <!-- 投稿のID -->
            <input type="hidden" name="post_id" value="{{ $post['id'] }}" >
            <div class="flex_item">
              <input type="hidden" name="img" value="{{ $img}}" >
              @foreach($all as $a)
                @if($comment->user_id == $a->id)
                  <img class="icon2" src="images/{{$a->user_img}}" alt="">
                @endif
              @endforeach
              <div class="comment_box">
                <span>{{ $comment->name }}</span><span> |  {{ $comment->created_at }}</span>
                <p>{{ $comment->comment }}</p>
              </div>
            </div>
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" >
            @if($comment->user_id == $user['id'] )
              <input class="btn_des btn_com" type="submit" name="commit" value="コメント削除" formmethod="post" formaction="{{ url('/delite') }}">
            @endif
            <div class="comment_border"></div>
          </form>
        @endforeach
      </div>
    </section>
  </div>
</div>
@include ('common.footer')

