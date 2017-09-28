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
                                <h4 class="title">Danh sách danh mục tin</h4>
                                <?php
                                    if(isset($_POST['msg'])){
                                ?>
                                <p class="category success">Thêm thành công</p>
                                <?php
                                    }
                                    if($_SESSION['arUser']['id_user'] == 1){
                                ?>
                                <a href="addCat.php" class="addtop"><img src="/templates/admin/assets/img/add.png" alt="" /> Thêm</a>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Tên danh mục</th>
                                        <?php 
                                        if($_SESSION['arUser']['username'] == "admin"){
                                        ?>
                                    	<th>Chức năng</th>
                                        <?php 
                                        }
                                        ?>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query1 = "SELECT * FROM category";
                                        $result1 = $mysqli->query($query1);
                                        while($ar1 = mysqli_fetch_assoc($result1)){
                                            $urlDel = "delCat.php?id={$ar1['id_cat']}";
                                            $urlEdit = "editCat.php?id={$ar1['id_cat']}";
                                        ?>
                                        <tr>
                                        	<td><?php echo $ar1['id_cat']; ?></td>
                                        	<td><a href="<?php echo $urlEdit; ?>"><?php echo $ar1['name']; ?></a></td>
                                            <?php 
                                            if($_SESSION['arUser']['username'] == "admin"){
                                            ?>
                                        	<td>
                                        		<a href="<?php echo $urlEdit; ?>"><img src="/templates/admin/assets/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                                        		<a href="<?php echo $urlDel; ?>" onclick="return xacNhanXoa()"><img src="/templates/admin/assets/img/del.gif" alt="" /> Xóa</a>
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
        