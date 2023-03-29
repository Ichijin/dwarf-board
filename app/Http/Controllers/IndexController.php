<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class IndexController extends Controller
{

    //ログイン画面の表示
    public function index()
    {
        return view('post/login');
    }

    //ajaxの処理
    public function ajax(Request $request)
    {
        $login = DB::table('users')
        ->where('email', $request->user_id)
        ->where('password', $request->password)
        ->first();
        return $login;
    }

    //ログアウト
    public function logout()
    {
        return redirect()->route('login');
    }

    //アカウント新規登録画面の表示
    public function singup()
    {
        return view('post/singup');
    }

    //アカウント新規登録の機能
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
        ],
        [
            'name.required' => 'ユーザー名は必須項目です。',
            'email.required'  => 'メールアドレスは必須項目です。',
            'password.required' => 'パスワードは必須項目です。'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return view('post/login');
    }

    //ユーザー管理画面の表示
    public function user(Request $request)
    {
        if(!$request->session()->get('user_id')) {
            return redirect('login');
        } else {
            $users = DB::table('users')
            ->get();
            $login = User::where('id', $request->id)->first();
            $request->session()->flash('flash_test', 'フラッシュデータのセッションテスト');
            session()->flash('user_id', $request->id);
            $user_id = session()->get('user_id');
            return view('post/userList', compact('users', 'login', 'user_id'));
        }

    }

    //アカウント編集機能
    public function update(Request $request)
    {
        session()->flash('user_id', $request->user_id);
        $request->validate( [
            'name'=>['required', Rule::unique('users')->ignore($request->user_id)],
            'email'=>['required', Rule::unique('users')->ignore($request->user_id)],
            'password' => 'required',
        ],
        [
            'name.required' => 'ユーザー名は必須項目です。',
            'email.required'  => 'メールアドレスは必須項目です。',
            'password.required'  => 'パスワードは必須項目です。',
        ]);

        $hidden_id = $request->user_id; //ログインしている人のid
            $post = posts::where('user_id', $request->user_id);
            $post->update([
                "name" => $request->name,
            ]);
            $comment = Comment::where('user_id', $request->user_id);
            $comment->update([
                "name" => $request->name,]);
            $users = User::find($hidden_id);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $request->password;
            $users->update();

            session()->flash('user_id', $hidden_id);
            $return_id = session()->get('user_id');
            return redirect()->route('test.show', ['id' => $return_id])
            ->with('message', '編集完了しました');
    }

    //ログインしている人のid取得、保存・ホーム画面の表示
    public function home(Request $request)
    {
        if($request->user_id) {
            $request->session()->flash('user_id', $request->user_id);
            $user_id = $request->session()->get('user_id');
        } else {
            $request->session()->flash('user_id', request()->query('id'));
            $user_id = $request->session()->get('user_id');
        }
        return view('post/index', compact('user_id'));
    }

    //新規投稿の画面表示
    public function post(Request $request)
    {
        if(!$request->session()->get('user_id')) {
            return redirect('login');
        } else {
            $user = User::where('id', $request->id)->first();
            return view('post/post', compact('user'));
        }
    }

    //新規投稿の機能
    public function create(Request $request)
    {
        session()->flash('user_id', $request->user_id);
        $request->validate([
            'post_title' => 'required',
            'post' => 'required',
        ],
        [
            'post_title.required' => 'タイトルは必須項目です。',
            'post.required'  => 'つぶやきは必須項目です。',
        ]);
        $post = new posts();
        $post->user_id = $request->user_id;
        $post->name = $request->user_name;
        $post->title = $request->post_title;
        $post->post = $request->post;
        $post->save();

        $id = $request->user_id;
        session()->flash('user_id', $request->user_id);
        return redirect()->route('show', ['id' => $id]);
    }

    //掲示板（自分だけ）の表示
    public function show(Request $request)
    {
        if(!$request->session()->get('user_id')) {
            return redirect('login');
        } else {
            $users = User::where('id', $request->id)
            ->first();
            $postdata = posts::where('user_id', $request->id)
            ->orderBy('created_at', 'desc')
            ->get();

    return view('post/list', compact('users', 'postdata'));
        }

    }

    //掲示板(みんなの書き込み画面)
    public function chat(Request $request)
    {
        if(!$request->session()->get('user_id')) {
            return redirect('login');
        } else {
            $user = $request->id;
            $postdata =  Posts::orderBy('created_at', 'desc')->get();
            $users = DB::table('users')->get();
            return view('post/chat', compact('postdata', 'user', 'users'));
        }
    }


    //掲示板（自分だけ）の削除
    public function destroy(Request $request)
    {
        $post_id = $request->post_id;
        $post = Posts::find($post_id)->destroy($post_id);

        $comment = comment::where('post_id', $post_id)->delete();

        session()->flash('user_id', $request->user_id);
        $user_id = session()->get('user_id');

        return redirect()->route('show', ['id' => $user_id]);
    }

    //掲示板（自分だけ）の内容編集
    public function edite(Request $request)
    {
        session()->flash('user_id', $request->user_id);
        $request->validate([
            'new_title' => 'required',
            'new_post' => 'required',
        ],
        [
            'new_title.required' => 'タイトルの空欄は無効です。',
            'new_post.required'  => 'つぶやきの空欄は無効です。',
        ]);
        $posts = Posts::find($request->post_id);
        $posts->name = $request->new_name;
        $posts->title = $request->new_title;
        $posts->post = $request->new_post;
        $posts->created_at = $request->new_created_at;
        $posts->update();

        session()->flash('user_id', $request->user_id);
        $user_id = session()->get('user_id');

        return redirect()->route('show', ['id' => $user_id]);
    }

    //コメント画面表示
    public function comment(Request $request)
    {
        if(!$request->session()->get('user_id') && !$request->post_id) {
            return redirect('login');
        } elseif ($request->post_id) {
            $post_id = $request->post_id;
            $img = $request->img;
            $post = posts::where('id', $post_id)
            ->first();
            $user = User::where('id', $request->user_id)
            ->first();
            $comments = comment::where('post_id', $post_id)
            ->get();
            $all = DB::table('users')->get();
            return view('post/comment', compact('post', 'user', 'comments', 'img','all'));
        } else {
            $post_id = $request->session()->get("post_id");
            $user_id = $request->session()->get("user_id");
            $img = $request->session()->get("img");
            $user = User::where('id', $user_id)
            ->first();
            $post = posts::where('id', $post_id)
            ->first();
            $comments = comment::where('post_id', $post_id)
            ->get();
            $all = DB::table('users')->get();

            $comment = Comment::where('user_id', $request->user_id);
            $comment->update([
                "name" => $request->name,
            ]);
            return view('post/comment', compact('post', 'user','comments', 'img','all'));
        }
    }

    //コメント機能
    public function commit(Request $request)
    {
        if($request->input('back') == '戻る'){
            $request->session()->flash('user_id', $request->user_id);
            return redirect('/chat')
                        ->withInput($request->only(['user_id']));

        } else {
            $request->validate([
                'comment' => 'required',
            ],
            [
                'comment.required' => '空欄でコメントできません。',
            ]);
            $postdata = $request->all();
            $user = User::find($request->user_id);
            $comments = Comment::where('post_id', $request->post_id)->get();

            $comment = new Comment();
            $comment->user_id = $request->user_id;
            $comment->post_id =  $request->post_id;
            $comment->name = $user->name;
            $comment->comment = $request->comment;
            $comment->save();

            session()->flash('user_id', $request->user_id);
            session()->flash('post_id', $request->post_id);
            session()->put('img', $request->img);

            return redirect()->action([IndexController::class, 'comment']);
        }
    }

        //コメントの削除
        public function delite(Request $request)
        {
            $comment_id = $request->comment_id;
            $comment = Comment::find($comment_id)->destroy($comment_id);

            session()->flash('user_id', $request->user_id);
            session()->flash('post_id', $request->post_id);
            session()->put('img', $request->img);

            return redirect()->action([IndexController::class, 'comment']);
        }
}
