<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';
?>
<body>

  <div class="wrapper">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php';
    ?>

   <div class="main-panel">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/navbar.php';
    ?>
    <?php 
    if(isset($_POST['login'])){
      $username = $_POST['username'];
      $password = md5($_POST['password']);
      $query = "SELECT * from users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
      $result = $mysqli->query($query);
      $arUser = mysqli_fetch_assoc($result);
      if(count($arUser) == 0){
        echo '<p style="color:red">Sai username hoặc password</p>';
      }else{
        if($arUser['active'] != 0){
          $_SESSION['arUser'] = $arUser;
          header("location:index.php");
          exit();
        }else{
          echo '<p style="color:red">Bạn bị khóa tài khoản</p>';
        }
      }
    }
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="POST" id="form">
            <h1>Login</h1>
            <input class="input" placeholder="Username" name="username" type="text" required="">
            <input class="input" placeholder="Password" name="password" type="password" required="">
            <input class="input" type="submit" class="button" name="login" value="Sign in">
          </form>
        </div>
      </div>
    </div>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php';
    ?>
