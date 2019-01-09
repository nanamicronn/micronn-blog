<!--
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-09
 * Time: 11:25
 */
-->

<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="blog.css">
</head>
<body>

<div class="first-main">
<form method="post">
    <h1>Log into nanablog</h1>
    <div class="form-group">
        <input type="email" class="form-controle" name="email" placeholder="EmailAddress"> <!--required-->
    </div>
    <p class="login-err">メールアドレスを入力してください。</p>
    <div class="form-group">
        <input type="password" class="form-controle" name="password" placeholder="Password"> <!--required-->
    </div>
    <p class="login-err">パスワードが間違っています。</p>
    <button type="submit" class="btn" name="login">Login</button>
    <p>Dont't have an a ccount?  <a href="list.php">createAccount</a></p>
</form>
</div>

</body>
</html>