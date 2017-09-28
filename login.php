<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/header.php';
?>
<body>
          <?php 
          if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $query = "SELECT * from member WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
            $result = $mysqli->query($query);
            $arU = mysqli_fetch_assoc($result);
            if(count($arU) == 0){
                echo "<strong>Sai username hoặc password</strong>";
            }else{
              $_SESSION['arU'] = $arU;
              header("location:index.php");die();
            }
        }
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <form action="" method="POST" id="form">
                      <h1 style="margin:0 auto;">  Đăng nhập</h1>
                      <input class="input" placeholder="Username" name="username" type="text" required="">
                      <input class="input" placeholder="Password" name="password" type="password" required="">
                      <input class="input" type="submit" class="button" name="login" value="Đăng nhập">
                </form>
            </div>
        </div>
    </div>

  
