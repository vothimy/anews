<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/header.php';
?>
<body>
          <?php 
          if(isset($_POST['dangki'])){
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $query = "SELECT * from member";
            $result = $mysqli->query($query);
            $num = 0;
            while($arUser = mysqli_fetch_assoc($result)){
                if($arUser['username'] == $username || $arUser['email'] == $email){
                    $num = 1;
                    echo "Tài khoản chưa hợp lệ";
                }
            }
            if($num != 1){
                $query1 = "INSERT INTO member(username,fullname,gmail,password) values ('{$username}','{$fullname}','{$email}','{$password}')";
                 $result1 = $mysqli->query($query1);
                 header("location:index.php");
            }
        }
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <form action="" method="POST" id="form">
                      <h1 style="margin:0 auto;">  Đăng kí</h1>
                      <input class="input" placeholder="Username(*)" name="username" type="text" required="">
                      <input class="input" placeholder="Fullname(*)" name="fullname" type="text" required="">
                      <input class="input" placeholder="Email(*)" name="email" type="text" required="">
                      <input class="input" placeholder="Password(*)" name="password" type="password" required="">
                      <input class="input" type="submit" class="button" name="dangki" value="Đăng kí">
                </form>
            </div>
        </div>
    </div>
  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php';
  ?>
