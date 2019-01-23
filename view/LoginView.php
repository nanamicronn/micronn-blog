<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="http://localhost:8888/blog/css/blog.css">
</head>
<body>

<div class="first-main">
    <form method="post" action="./login">
        <h1>Log into nanablog</h1>
        <div class="form-group">
            <input type="email" class="form-controle" name="email" placeholder="EmailAddress" value="<?php echo isset($_POST['email']) ? $_POST['email'] :''; ?>"> <!--required-->
        </div>
        <p class="login-err"><?php echo isset($err['email']) ? $err['email'] :''; ?></p>
        <div class="form-group">
            <input type="password" class="form-controle" name="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] :'';?>"> <!--required-->
        </div>
        <p class="login-err"><?php echo isset($err['password']) ? $err['password'] :''; ?></p>
        <input type="hidden" name="csrf_token" value="<?php echo Csrf::get()?>">
        <button type="submit" class="btn" name="login">Login</button>
        <p>Dont't have an a ccount?  <a href="./register">createAccount</a></p>
    </form>
</div>

</body>
</html>