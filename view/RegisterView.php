
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="http://localhost:8888/blog/css/blog.css">
</head>
<body>

<div class="first-main">
    <form method="post" action="./register">
        <h1>Create Account</h1>
        <div class="form-group">
            <input type="text" class="form-controle" name="username" placeholder="UserName" value="<?php echo isset($_POST['username']) ? $_POST['username'] :''; ?>"/>
        </div>
        <p class="login-err"><?php echo isset($err['username']) ? $err['username'] :''; ?></p>

        <div class="form-group">
            <input type="text" class="form-controle" name="email" placeholder="EmailAddress" value="<?php echo isset($_POST['email']) ? $_POST['email'] :''; ?>"/>
        </div>
        <p class="login-err"><?php echo isset($err['email']) ? $err['email'] :''; ?></p>

        <div class="form-group">
            <input type="password" class="form-controle" name="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] :'';?>"/>
        </div>
        <p class="login-err"><?php echo isset($err['password']) ? $err['password'] :''; ?></p>

        <input type="hidden" name="csrf_token" value="<?php echo Csrf::get()?>">
        <button type="submit" class="btn" name="register">CreateAccount</button>
        <p>Already have an account?   <a href="./login">Login here</a></p>
    </form>
</div>

</body>
</html>