<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>企業・ビジネスサイト向け 無料ホームページテンプレート tp_biz52</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ここにサイト説明を入れます">
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５"> -->
<link rel="stylesheet" href="css/style.css">
<script src="js/openclose.js"></script>
</head>

<body class=singup>
  <main>
    <form class="login_form" name="login_form" action="{{ url('/store') }}" method="POST">
      @csrf
      <div id="container">
        <div id="contents">
          <div id="main">
            <section class="box_1">
              <h2 class="title">Sing Up<span>新規登録</span></h2>
              <p>ニックネーム、メールアドレス、パスワードをご入力の上、「登録」ボタンをクリックしてください。</p>
              <table class="ta1">
                @if ($errors->has('name'))
                  <tr>
                    <th>ニックネーム</th>
                    <td>
                      <input class="txt" type="text" id="user_name" name="name" value="{{ old('name') }}"><span class="errmes">{{ $errors->first('name') }}</span>
                    </td>
                  </tr>
                @else
                  <tr>
                    <th>ニックネーム</th>
                    <td><input class="txt" type="text" id="user_name" name="name"  value="{{ old('name') }}"></td>
                  </tr>
                @endif
                @if ($errors->has('email'))
                  <tr>
                    <th>メールアドレス</th>
                    <td>
                      <input class="txt" type="id" id="user_id" name="email" value="{{ old('email') }}"><span class="errmes">{{ $errors->first('email') }}</span>
                    </td>
                  </tr>
                @else
                  <tr>
                    <th>メールアドレス</th>
                    <td><input class="txt" type="id" id="user_id" name="email" value="{{ old('email') }}"></td>
                  </tr>
                @endif
                @if ($errors->has('password'))
                  <tr>
                    <th>パスワード</th>
                    <td>
                      <input class="txt" type="password" id="password"  name="password" value="{{ old('password') }}"><span class="errmes">{{ $errors->first('password') }}</span>
                    </td>
                  </tr>
                @else
                  <tr>
                    <th>パスワード</th>
                    <td><input class="txt" type="password" id="password"  name="password" value="{{ old('password') }}"></td>
                  </tr>
                @endif
              </table>
              <div class="sub_b">
                <button class="btn_des1" id="submit_btn" type="submit">登録</button>
                <a class="btn_des1" href="login">ログイン画面へ戻る</a>
            </section>
          </div><!--/#main-->
        </div><!--/#contents-->
      </div>
    </form>
  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</form>
</body>
</html>
