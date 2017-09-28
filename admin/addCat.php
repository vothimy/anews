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
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Thêm danh mục</h4>
                            </div>
                            <div class="content">
                                <?php 
                                    if($_SESSION['arUser']['id_user'] != 1){
                                        header("location:indexCat.php");die();
                                    }
                                    $query = "SELECT * FROM category";
                                    $result = $mysqli->query($query);
                                    if(isset($_POST['add'])){
                                        $name1 = $mysqli->real_escape_string($_POST['name']);
                                        if ($name1 == '') {
                                            echo "không được nhập dữ liệu rỗng";
                                        }else{
                                            $num = 0;
                                            while($ar = mysqli_fetch_assoc($result)){
                                                if($name1 == $ar['name']){
                                                    $num =1 ;
                                                    echo "Danh mục này đã có!";
                                                   
                                                }
                                            }
                                            if($num == 0){
                                                $queryA = "INSERT INTO category(name) VALUES ('{$name1}') ";
                                                    $result = $mysqli->query($queryA);
                                                    if($result){
                                                        header("location:indexCat.php?msg=Thêm thành công!");
                                                        exit();
                                                    }else{
                                                        echo "Lỗi khi thêm";
                                                    }
                                            }
                                        }
                                    }
                                ?>
                                <form action="" method="POST" id="frmAC">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tên danh mục(*)</label>
                                                <input type="text" name="name" class="form-control border-input"  value="" >
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
                                        $("#frmAC").validate({
                                            rules:{               
                                                name:{
                                                    required:true,
                                                }
                                            },
                                            messages:{
                                                name:{
                                                    required:"<span style='color:red;font-weight:bold'>-Tên danh mục không được để trống</span>",
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
