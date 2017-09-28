<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';
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
      $query = "SELECT * FROM users";
      $result = $mysqli->query($query);
      ?>
      <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Thêm user</h4>
                        </div>
                        <div class="content">
                            <?php
                             if($_SESSION['arUser']['id_user'] != 1){
                                header("location:indexUser.php");die();
                            }
                            if(isset($_POST['add'])){
                                $username = $mysqli->real_escape_string($_POST['username']);
                                $password = $mysqli->real_escape_string(md5($_POST['password']));
                                $fullname = $mysqli->real_escape_string($_POST['fullname']);
                                $dem = strpos($username,"'");
                                if($username == '' || $fullname == ''){
                                    echo "Không được nhập dữ liệu rỗng!";
                                }else{
                                    if($dem == null){
                                        while($ar = mysqli_fetch_assoc($result)){
                                            if($username == $ar['username']){
                                                $num = 1;
                                                echo '<p style="color:red"> Tên người dùng đã có!</p>';
                                            }
                                        }
                                        if($num != 1){
                                            $queryA = "INSERT INTO users(username,password,fullname,active) VALUES ('$username','$password','$fullname',1) ";
                                            $mysqli->query($queryA);
                                            header("location:indexUser.php?msg=Thêm thành công!");
                                            exit();
                                        }
                                    }else{
                                        echo '<span style="color:red">Tên đăng nhập sai</span>';
                                    }
                                }
                            }
                            ?>
                            <form action="" method="post" id="frmDK">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tên user(*)</label>
                                            <input type="text" name="username" class="form-control border-input"  value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control border-input"  value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Fullname(*)</label>
                                            <input type="text" name="fullname" class="form-control border-input"  value="">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <input type="submit" name="add" class="btn btn-info btn-fill btn-wd" value="Thêm" />
                                </div>
                                <div class="clearfix"></div>
                            </form>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $("#frmDK").validate({
                                        rules:{               
                                            "username":{
                                                required:true,
                                            },
                                            "fullname":{
                                                required:true,
                                            },
                                            "password":{
                                                required:true
                                            }
                                        },
                                        messages:{
                                            "username":{
                                                required:" <br /><span style='color:red;font-weight:bold'>-Tên truy cập không được để trống</span>",
                                            },
                                            "fullname":{
                                                required:"<br /><span style='color:red;font-weight:bold'>-Tên đầy đủ không được để trống</span>",
                                            },
                                            "password":{
                                                required:"<br /><span style='color:red;font-weight:bold'>-Password không được để trống</span>",
                                            }
                                        }
                                    });
                                });
                            </script>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php';
    ?>
