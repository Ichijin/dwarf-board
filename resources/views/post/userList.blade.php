@include ('common.header')

  <main id="main_user">
    <div id="container_user">
      <h2 class="title">Account<span>ユーザー管理</span></h2>
      @if ($errors->has('name'))
        <p class="alert">{{ $errors->first('name') }}</p>
      @endif
      @if ($errors->has('email'))
        <p class="alert">{{ $errors->first('email') }}</p>
      @endif
      @if ($errors->has('password'))
        <p class="alert">{{ $errors->first('password') }}</p>
      @endif
      <div class="edit_sec">
        <table class="table_design">
          <thead>
            <tr class="tr_design">
              <th class="th_design th_design_id">id</th>
              <th class="th_design">ニックネーム</th>
              <th class="th_design">ユーザーID</th>
              <th class="th_design">パスワード</th>
              <th class="th_design"></th>
            </tr>
          </thead>
          <form name="list" id="home_form" method="post"  action="{{ url('/update') }}">
            @csrf
            <p class="vertical">edit</p>
            <tbody>
              <tr class="tr_design">
                <input type="hidden" name="user_id" value="{{ $user_id }}"/>
                <td class="td_design"><p>{{ $user_id }}</p></td>
                <td class="td_design"><input class="input_design" type="name" name="name" value="{{ $login->name }}"></td>
                <td class="td_design"><input class="input_design" type="text" name="email" value="{{ $login->email }}"></td>
                <td class="td_design"><input class="input_design" type="text" name="password" value="{{ $login->password }}"></td>
                <td class="td_design btnWidth"><input id="btn" type="submit" name="editBtn" value="編集"></td>
              </tr>
            </tbody>
          </form>
        </table>
      </div>
      <div class="userlist_sec">
        <table class="table_design">
          <thead>
            <tr class="tr_design">
              <th class="th_design th_design_id">id</th>
              <th class="th_design th_design_name">ニックネーム</th>
              <th class="th_design th_design_userid">ユーザーID</th>
              <th class="th_design th_design_img">アイコン画像/アイコン名</th>
            </tr>
          </thead>
          <p class="vertical">userlist</p>
          @foreach($users as $user)
            @csrf
            <tbody>
              <tr class="tr_design">
                <td class="td_design">{{ $user->id }}</td>
                <td class="td_design">{{ $user->name }}</td>
                <td class="td_design">{{ $user->email }}</td>
                <td class="td_design"><img class="icon2" src="/public/images/{{ $user->user_img }}" name="user_img"><span>{{ $user->user_img }}</span></td>
              </tr>
            </tbody>
          @endforeach
        </table>
      
    </main>
    </div>
  </div>
</body>
@include ('common.footer')