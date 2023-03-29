@include('common.header')
<div id="contents">
  <div id="main_chat">
    <h2 class="title">Chat Room<span>掲示板</span></h2>
    <section id="pagetop">
      @foreach($postdata as $post)
        <form action="?" id="home_form">
          @csrf
          <input type="hidden" name="post_id" value="{{ $post->id }}" >
          <div id="my_icon">
            @foreach($users as $use)
              @if($post->user_id == $use->id)
                <img class="icon1" src="images/{{$use->user_img}}" alt="">
                <input type="hidden" name="img" value="{{ $use->user_img}}" >
              @endif
            @endforeach
            <table class="ta2">
              <tr>
                <th>投稿日時</th>
                <td class="ws">{{ $post->created_at }}</td>
              </tr>
              <tr>
                <th>名前</th>
                <td class="ws">{{ $post->name }}</td>
              </tr>
              <tr>
                <th>タイトル</th>
                <td class="ws">{{ $post->title }}</td>
              </tr>
              <tr>
                <th>つぶやき</th>
                <td cols="30" rows="10" class="wl">{{ $post->post }}</td>
              </tr>
              <input type="hidden" name="user_id" value="{{ old('user_id', $user_id) }}" >
            </table>
           </div>
           <input class="btn_des" type="submit" name="comment" value="コメントする" formmethod="get" formaction="{{ url('/comment') }}" >
        </form>
      @endforeach
    </section>
  </div>
</div>
@include('common.footer')