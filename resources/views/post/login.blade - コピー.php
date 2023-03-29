<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>掲示板</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ここにサイト説明を入れます">
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５">
<link rel="icon" type="image/png" sizes="16x16"  href="../../../public/images/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<link rel="stylesheet" href="css/style.css">
<script src="js/openclose.js"></script>
</head>

<body class=login>
  <main>
    <form class="login_form" name="login_form" >
      <meta name="csrf-token" content="{{ csrf_token() }}">
      @csrf
      <div id="container">
        <div id="contents">
          <div id="main">
            <section class="box_1">
              <h2 class="title">Login<span>ログイン</span></h2>
              <p>メールアドレスとパスワードを入力してください。</p>
              <table class="ta1">
                <tr>
                  <th>メールアドレス</th>
                  <td><input class="txt" type="id" id="user_id" name="user_id" value="{{ old('user_id') }}"><span class="errMail errmes"></span></td>
                </tr>
                <tr>
                  <th>パスワード</th>
                  <td><input class="txt" type="password" id="password" name="password" value="{{ old('password') }}"><span class="errPassword errmes"></span></td>
                </tr>
              </table>
              <div class="sub_b">
                <input class="btn_des1" type="button" id="submit_btn" value="ログイン">
                <a class="btn_des1" href="singup">アカウント新規作成</a>
              </div>
            </section>
          </div>
        </div>
      </div>
    </form>
  </main><!-- End #main -->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
    $(function(){
      $('#submit_btn').click(function(){
        if($('#user_id').val() === "") {
          $('.errMail').text("メールアドレスは必須項目です。");//エラーメッセージ表示
          } else {                                           //入力されている場合
              $('.errMail').text("");                         //エラーメッセージなし
          }

        if($('#password').val() === "") {
          $('.errPassword').text("パスワードは必須項目です。");//エラーメッセージ表示
          } else {                                           //入力されている場合
              $('.errPassword').text("");                    //エラーメッセージなし
          }

        // let form = $(this.form);
        $.ajaxSetup({
          headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
          url     :   'ajax',
          type    :   'post',
          data: {
                // パラメーターを設定
                user_id: $('#user_id').val(),
                password: $('#password').val()
          }     //formで送信している内容を送る
      })
      .done((res) => {
          if(res.id){
                  location.href = "home?id="+res.id;
              }
              if(!res){
                  alert('登録されていません');
              }
            })
            .fail(function(){
          alert('登録されていません');
              location.href = "login";
        });
      });
    });
  </script>
</body>
</html>

