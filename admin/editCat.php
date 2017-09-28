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
          $query1 = "SELECT * FROM category WHERE id_cat = '{$id}' ";
          $result1 = $mysqli->query($query1);
          $ar1 = mysqli_fetch_assoc($result1);
          ?>
          <div class="contendmt">
          <?php 
            if(isset($_POST['sua'])){
                $tendm = $mysqli->real_escape_string($_POST['tendm']);
                $dem = strpos($tendm,"'");
                if($tendm == ' '){
                    echo "<b>Không được nhập vào rỗng!</b>";
                }else{
                    if($dem == null){
                        $queryCat = "SELECT * FROM category WHERE id_cat <> $id";
                        $resultCat = $mysqli->query($queryCat);
                        $num = 0;
                        while($arCat = mysqli_fetch_assoc($resultCat)){
                            if($tendm == $arCat['name']){
                                $num = 1;
                                echo '<span style="color:red">Tin tức này đã có!</span>';
                            }
                        }
                        if($num == 0){
                            $queryEdit = "UPDATE category SET name ='{$_POST['tendm']}' WHERE id_cat = {$id} LIMIT 1";
                            $resultEdit = $mysqli->query($queryEdit);
                            header('location:indexCat.php?msg=Sửa thành công');
                            exit();
                        }
                    }else{
                        echo '<span style="color:red">Tên danh mục sai!</span>';
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
                            <div class="contendmt">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên tin</label>
                                                <input type="text" name="tendm" class="form-control border-input" value="<?php echo $ar1['name']; ?>">
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