@include('common.header')
  <div id="contents">
    <div id="main_chat">
      <section id="pagetop">
        <h2 class="title">My Chat<span>掲示板</span></h2>
        @if ($errors->has('new_title'))
          <p>{{ $errors->first('new_title') }}</p>
        @endif
        @if ($errors->has('new_post'))
          <p>{{ $errors->first('new_post') }}</p>
        @endif
        @foreach($postdata as $post)
          <form action="?" id="home_form">
            @csrf
              <input type="hidden" name="user_id" value="{{ $users->id }}" />
              <div class="flex_item">
                <img  class="icon1" src="images/{{$users->user_img}}" alt="">
                <table class="ta1">
                  <tr>
                    <th>投稿日時</th>
                    <td>{{ $post->created_at }}</td>
                    <input type="hidden" name="new_created_at" value="{{ $post->created_at }}">
                  </tr>
                  <tr>
                    <th>名前</th>
                    <td>{{ $post->name }}</td>
                    <input type="hidden" name="new_name" value="{{ $post->name }}">
                  </tr>
                  <tr>
                    <th>タイトル</th>
                    <td><input type="text" name="new_title" size="30" class="ws" value="{{ $post->title }}"></td>
                    <input type="hidden" name="title" value="{{ $post->title }}">
                  </tr>
                  <tr>
                    <th>つぶやき</th>
                    <td><textarea name="new_post" cols="30" rows="10" class="wl" value="">{{ $post->post }}</textarea></td>
                    <input type="hidden" name="post" value="{{ $post->post }}">
                  </tr>
                </table>
              </div>
              <div class="c">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input class="btn_des1 btn_com" type="submit" name="delete" value="削除" formmethod="post" formaction="{{ url('/destroy') }}">
                <input class="btn_des1 btn_com" type="submit" name="edit" value="編集" formmethod="post" formaction="{{ url('/edite') }}">
              </div>
          </form>
        @endforeach
      </section>
    </div>
  </div>
@include('common.footer')