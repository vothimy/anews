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
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách người dùng</h4>
                        <?php
                            if(isset($_POST['msg'])){
                        ?>
                        <p class="category success">Thêm thành công</p>
                        <?php
                            }
                            if($_SESSION['arUser']['username'] == "admin"){
                        ?>
                        <a href="addUser.php" class="addtop"><img src="/templates/admin/assets/img/add.png" alt="" /> Thêm</a>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <th class="text-center">ID</th>
                                <th class="text-center">Tên đăng nhập</th>
                                <th class="text-center">Họ và tên</th>
                                <?php
                                if($_SESSION['arUser']['username'] == "admin"){
                                ?>
                                <th class="text-center">Hoạt động</th>
                                <?php
                                }
                                ?>
                                <th class="text-center">Chức năng</th>
                            </thead>
                            <tbody>
                                <?php
                                    $query1 = "SELECT * FROM users";
                                    $result1 = $mysqli->query($query1);
                                    while($ar1 = mysqli_fetch_array($result1)){
                                        $urlDel = "delUser.php?id={$ar1['id_user']}";
                                        $urlEdit = "editUser.php?id={$ar1['id_user']}";
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $ar1['id_user'] ;?></td>
                                    <td class="text-center"><a href="<?php echo $urlEdit;?>"><?php echo $ar1['username'] ;?></a></td>
                                    <td class="text-center"><?php echo $ar1['fullname'] ;?></td>
                                    <?php
                                    if($_SESSION['arUser']['username'] == "admin"){
                                    ?>
                                    <td  class="id-user-<?php echo $ar1['id_user']; ?> text-center" >
                                        <?php 
                                            if ($ar1['active'] == 0){
                                        ?>
                                        <a href="javascript:void(0)" onclick="changeActive(<?php echo $ar1['id_user'] ; ?>, 1)">
                                            <img src="/templates/admin/assets/img/deactive.gif" alt="" />
                                        </a>
                                        <?php
                                            }else{
                                        ?>
                                        <a href=" javascript:void(0)" onclick="changeActive(<?php echo $ar1['id_user'] ; ?>, 0)">
                                            <img src="/templates/admin/assets/img/active.gif" alt="" />
                                        </a>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                    <td class="text-center">
                                        <?php
                                        if($_SESSION['arUser']['username'] == "admin" || $_SESSION['arUser']['username'] == $ar1['username']){
                                        ?>
                                        <a href="<?php echo $urlEdit;?>"><img src="/templates/admin/assets/img/edit.gif" alt="" /> Sửa</a>
                                        <?php
                                        if($ar1['username'] != "admin"){
                                            if($_SESSION['arUser']['username'] == "admin"){
                                        ?>
                                         &nbsp;||&nbsp;
                                        <a href="<?php echo $urlDel;?>" onclick="return xacNhanXoa()"><img src="/templates/admin/assets/img/del.gif" alt="" /> Xóa</a>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                        <?php
                                        }
                                        ?>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function changeActive(id_user, check){
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            cache: false,
            data: {
                acheck : check,
                aid : id_user
            },
            success: function(data){
                $('.id-user-'+id_user).html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });     
    }
</script>
<script type="text/javascript">
    function xacNhanXoa(){
        var x = confirm('Bạn có chắc muốn xóa');
        if(x){
            return true;
        }else{
            return false;
        }
    }
</script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php' ;
?>
