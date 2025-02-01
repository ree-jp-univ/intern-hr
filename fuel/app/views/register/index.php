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

    .login-container input {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .login-container button {
        width: 100%;
        padding: 10px;
        background-color: #447ACB;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .login-container button:hover {
        background-color: #2A4C80;
    }

    .login-container a {
        /* display: block; */
        padding-top: 32px;
        margin-bottom: 8px;
        color: #447ACB;
        text-decoration: none;
    }

    .login-container a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-body">
    <div class="login-container">
        <h1>アカウント登録</h1>
        <?php echo \Fuel\Core\Form::open(['action' => 'register', 'method' => 'post']); ?>
        <div class="form-group">
            <label for="username">ユーザー名</label>
            <?php echo \Fuel\Core\Form::input('username', null, ['type' => 'text']); ?>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <?php echo \Fuel\Core\Form::password('password', null, ['type' => 'password']); ?>
        </div>
        <div>
            <p><?php echo \Fuel\Core\Session::get_flash('message') ?></p>
        </div>
        <?php echo \Fuel\Core\Form::button('登録', null, ['class' => 'btn btn-primary']); ?>
        <?php echo \Fuel\Core\Form::close(); ?>
        <a href="/login">ログインはこちらから</a>
    </div>
</div>