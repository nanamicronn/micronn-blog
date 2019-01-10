<!--
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-09
 * Time: 15:14
 */
-->

<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="blog.css">
</head>
<body>

<div class="first-main">
    <form method="post">
        <h1>Create Account</h1>
        <div class="form-group">
            <input type="text" class="form-controle" name="username" placeholder="UserName"/>
        </div>
        <p class="login-err"><?php echo isset($err['username']) ? $err['username'] :''; ?></p>

        <div class="form-group">
            <input type="email" class="form-controle" name="email" placeholder="EmailAddress"/>
        </div>
        <p class="login-err"><?php echo isset($err['email']) ? $err['email'] :''; ?></p>

        <div class="form-group">
            <input type="password" class="form-controle" name="password" placeholder="Password"/>
        </div>
        <p class="login-err"><?php echo isset($err['password']) ? $err['password'] :''; ?></p>

        <button type="submit" class="btn" name="register">CreateAccount</button>
        <p>Already have an account?   <a href="list.php">Login here</a></p>
    </form>
</div>

</body>
</html>