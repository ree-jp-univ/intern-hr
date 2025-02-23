<?php echo \Fuel\Core\Asset::css('login.css'); ?>

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