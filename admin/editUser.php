<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php' ;
require_once $_SERVER['DOCUMENT_ROOT'] . '/function/checklogin.php';
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
      $id = $_GET['id'];
      $query1 = "SELECT * FROM users WHERE id_user = '{$id}' ";
      $result1 = $mysqli->query($query1);
      $ar1 = mysqli_fetch_assoc($result1);
      ?>
      <div class="content">
          <?php
          $id = $_GET['id'];
          if(isset($_POST['sua'])){
            $username = $mysqli->real_escape_string($_POST['username']);
            $password = $mysqli->real_escape_string($_POST['password']);
            $password_md5 = md5($password);
            $fullname = $mysqli->real_escape_string($_POST['fullname']);
            $dem = strpos($username,"'");

            if($username == '' || $fullname == ''){
                echo "Không nhập dữ liệu rỗng!";
            }else{
                if($dem == null){
                    $query1 = "SELECT * FROM users WHERE id_user <> $id";
                    $result1 = $mysqli->query($query1);
                    $num = 0;
                    while($arU = mysqli_fetch_assoc($result1)){
                        if($username == $arU['username']){
                            $num = 1;
                            echo '<span style="color:red">Không được dùng tên username đã có!</span>';
                        }
                    }
                    if($num != 1){
                        if($password == ''){
                           $queryE1 = "UPDATE users SET username = '{$username}',fullname = '{$fullname}' WHERE id_user = {$id} LIMIT 1";
                           $result1 = $mysqli->query($queryE1);
                           if($result1){
                                        //chuyển hướng
                               header("location:indexUser.php?msg=Sửa thành công!");
                               exit();
                           }else{
                            echo "Lỗi khi sửa";
                        }

                    }else{
                       $queryE2 = "UPDATE users SET username = '{$username}',password = '{$password_md5}',fullname = '{$fullname}' WHERE id_user = {$id} LIMIT 1";
                       $result2 = $mysqli->query($queryE2);
                       if($result2){
                                            //chuyển hướng
                           header("location:indexUser.php?msg=Sửa thành công!");
                           exit();
                       }else{
                        echo "Lỗi khi sửa";
                    }
                }
            }


        }else{
            echo '<span style="color:red">tên đăng nhập sai</span>';
        }
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Sửa thông tin</h4>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#frmEU").validate({
                        debug:false,
                        rules:{               
                            "username":{
                                required:true,
                            },
                            "fullname":{
                                required:true
                            }
                        },
                        messages:{
                            "username":{
                                required:"<span style='color:red;font-weight:bold'>-Tên người dùng không được để trống</span>",
                            },
                            "fullname":{
                                required:"<span style='color:red;font-weight:bold'>-Fullname không được để trống</span>",
                            }
                        }
                    });
                });
                </script> 
                <div class="content">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                <label>Tên người dùng</label>
                                    <input type="text" name="username" class="form-control border-input" value="<?php echo $ar1['username']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control border-input" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" name="fullname" class="form-control border-input" value="<?php echo $ar1['fullname']; ?>">
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-info btn-fill btn-wd" name="sua" value="Sửa" />
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php' ;
?>