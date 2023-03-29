@include('common.header')

<body>
  <main>
    <form action="{{ url('/create') }}" method="POST" id="home_form">
      @csrf
      <div id="contents">
        <div id="main_user">
          <section class="post_box">
            <h2 class="title">New Post<span>新規投稿</span></h2>
            <div id="userName">
              <div class="flex_item">
                <div class="user_post">
                  <label class="label01">つぶやく人</label>
                  <input type="hidden" name="user_name" value="{{ $user->name }}">
                  <p class="post_user">{{ $user->name }}</p>
                </div>
                <img class="icon2" src="/public/images/{{ $user->user_img }}" name="user_img">
              </div>
            </div>
            <div id="postTitle">
              @if ($errors->has('post_title'))
                <p class="alert">{{ $errors->first('post_title') }}</p>
              @endif
              <label class="label02">タイトル</label>
              <input type="text" class="post_title" name="post_title" id="title" value="{{ old('post_title') }}">
            </div>
            <div id="post">
              @if ($errors->has('post'))
                <p class="alert">{{ $errors->first('post') }}</p>
              @endif
              <label class="label03">つぶやき</label>
              <textarea class="post" name="post">{{ old('post') }}</textarea>
            </div>
            <input type="hidden" name="user_id" value="{{ $user->id }}" >
            <div class="actions">
              <input type="reset" value="書き直す" class="reset btn_des1"/>
              <input id="primary_btn" type="submit" value="投稿する" class="primary btn_des1" />
          </section>
        </div>
      </div>
    </form>
  </main>
</body>
@include('common.footer')
