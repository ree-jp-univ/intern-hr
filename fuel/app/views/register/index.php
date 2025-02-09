<style>
    .login-body {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        max-width: 400px;
        padding: 10px;
    }

    .login-container h1 {
        text-align: center;
        margin-bottom: 24px;
        font-size: 24px;
    }

    .login-container a {
        padding-top: 32px;
        margin-bottom: 8px;
        color: #447ACB;
        text-decoration: none;
    }

    .login-container a:hover {
        text-decoration: underline;
    }

    .login-container .message {
        color: #BE524B;
    }
</style>

<div class="login-body">
    <div class="login-container">
        <h1>アカウント登録</h1>
        <?php echo \Fuel\Core\Form::open(['action' => 'register', 'method' => 'post']); ?>
        <div class="form-group">
            <label for="username">ユーザー名</label>
            <?php echo \Fuel\Core\Form::input('username', null, ['class' => 'w-full', 'type' => 'text']); ?>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <?php echo \Fuel\Core\Form::password('password', null, ['class' => 'w-full', 'type' => 'password']); ?>
        </div>
        <div>
            <p class="message"><?php echo \Fuel\Core\Session::get_flash('message') ?></p>
        </div>
        <?php echo \Fuel\Core\Form::button('登録', null, ['class' => 'btn-primary w-full']); ?>
        <?php echo \Fuel\Core\Form::close(); ?>
        <a href="/login">ログインはこちらから</a>
    </div>
</div>