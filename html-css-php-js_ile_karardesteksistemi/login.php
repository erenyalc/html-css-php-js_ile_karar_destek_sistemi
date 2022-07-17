<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta name="description" content="KDS">
    <link href="tasarim.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
</head>
<body>
<?php
    require('db.php');
    session_start();
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: atolye_genel.php");
        } else {
            echo "
            <div class='form'>
                  <h3>Kullanıcı adı veya şifre hatalı.</h3><br/>
                  <p class='link'>Yeniden denemek için <a href='login.php'>buraya</a> tıklayın.</p>
                  </div>";
        }
    } else {
?>
<div class="genel"></div>
    <i class="fas fa-couch"></i>
    <span class='basliik'>NORMAL MOBİLYA</span>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Kullanıcı Girişi</h1>
        <input type="text" class="login-input" name="username" placeholder="Kullanıcı adı" autofocus="true" required="" />
        <input type="password" class="login-input2" name="password" placeholder="Şifre" required=""/>
        <input type="submit" value="Giriş Yap" name="submit" class="login-button"/>
  </form>
<?php
    }
?>
</body>
</html>
