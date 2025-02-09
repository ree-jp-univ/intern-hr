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
    
    .login-container button {
        width: 100%;
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
        <h1>ログイン</h1>
        <?php echo \Fuel\Core\Form::open(['action' => 'login', 'method' => 'post']); ?>
        <div class="form-group">
            <label for="username">ユーザー名</label>
            <?php echo \Fuel\Core\Form::input('username', null, ['class' => 'w-full', 'type' => 'text']); ?>
        </div>
        <div class="form-group">
            <label for="passowrd">パスワード</label>
            <?php echo \Fuel\Core\Form::input('password', null, ['class' => 'w-full', 'type' => 'password']); ?>
        </div>
        <div>
            <p class="message"><?php echo \Fuel\Core\Session::get_flash('message') ?></p>
        </div>
        <?php echo \Fuel\Core\Form::button('ログイン', null, ['class' => 'btn-primary w-full']); ?>
        <?php echo \Fuel\Core\Form::close(); ?>
        <a href="/register">アカウント登録はこちらから</a>
    </div>
</div>