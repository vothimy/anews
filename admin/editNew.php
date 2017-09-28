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
          $query1 = "SELECT * FROM news WHERE id_news = '{$id}' ";
          $result1 = $mysqli->query($query1);
          $ar1 = mysqli_fetch_assoc($result1);
          if($_SESSION['arUser']['id_user'] != 1 && $_SESSION['arUser']['id_user'] != $ar1['id_user']){
            header("LOCATION:indexNews.php");
          }
          ?>
          <div class="content">
          <?php
            if(isset($_POST['sua'])){
                $tentin = $mysqli->real_escape_string($_POST['tentin']);
                $time = time();
                $date = date("Y-m-d H:i:s");
                $danhmuc = $_POST['danhmuc'];
                $mota = $_POST['mota'];
                $chitiet = $_POST['chitiet'];
                $hinhanh = $_FILES['hinhanh']['name'];
                if($tentin == ' ' || $mota == ' ' || $chitiet == ' '){
                    echo "Không được nhập dữ liệu rỗng!";
                }else{
                    $queryEdit = "SELECT * FROM news WHERE id_news <> $id ";
                    $resultEdit = $mysqli->query($queryEdit);
                    $num = 0 ;
                    while($arEdit = mysqli_fetch_assoc($resultEdit)){
                        if($tentin == $arEdit['name']){
                            $num = 1;
                            echo '<span style="color:red">Tin tức này đã có!</span>';
                        }
                    }
                    if($num == 0){
                        if($hinhanh != ''){
                            $obj->deleteFile($arNew['picture']);
                            $pic_new = $obj->uploadFile($hinhanh);
                            if($pic_new != false){
                                //up load thành công,sửa tin
                                $sql2 = "UPDATE news SET name = '{$tentin}',id_cat = {$danhmuc},preview_text = '{$mota}',
                                        detail_text = '{$chitiet}',picture = '{$pic_new}',date_edit = '{$date}'
                                        WHERE id_news = {$id} LIMIT 1 ";
                                $ketqua2 = $mysqli->query($sql2);
                                if($ketqua2){
                                    header("location:indexNews.php?msg=Sửa thành công");
                                    exit();
                                }else{
                                    echo "Lỗi khi sửa thông tin!";
                                }
                            }else{
                                echo "có lỗi khi up hình!";
                            }
                        }else{
                                // không up hình mới,có xóa hình cũ
                            if(isset($_POST['xoa'])){
                                $obj->deleteFile($ar1['picture']);
                                $sql3 = "UPDATE news SET name = '{$tentin}',id_cat = {$danhmuc},preview_text = '{$mota}',
                                        detail_text = '{$chitiet}',picture = '',picture ='',date_edit = '{$date}'
                                        WHERE id_news = {$id} LIMIT 1 ";
                                $ketqua3 = $mysqli->query($sql3);
                                if($ketqua3){
                                    header("location:indexNews.php?msg=Sửa thành công");
                                    exit();
                                }
                            }else{
                                 //không up mới, không xóa cũ
                                $sql4 = "UPDATE news SET name = '{$tentin}',id_cat = {$danhmuc},preview_text = '{$mota}',
                                        detail_text = '{$chitiet}',date_edit = '{$date}'
                                        WHERE id_news = {$id} LIMIT 1   ";
                                $ketqua4 = $mysqli->query($sql4);
                                if($ketqua4){
                                    header("location:indexNews.php?msg=Sửa thành công");
                                    exit();
                                }
                            }
                        }
                    }

                }
            }

            if(isset($_POST['huy'])){
                header("location:indexNews.php");
            }

            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sửa thông tin</h4>
                            </div>
                            <div class="content">
                                <form action="" method="post" id="frmEN" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Tên tin</label>
                                                <input type="text" name="tentin" class="form-control border-input" value="<?php echo $ar1['name']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Danh mục</label>
                                                <select name="danhmuc" class="form-control border-input">
                                                    <?php
                                                    $queryDM = "SELECT * FROM category ";
                                                    $mysql = $mysqli->query($queryDM);
                                                    while($arDM = mysqli_fetch_assoc($mysql)){
                                                        $id_cat = $arDM['id_cat'];
                                                        $name = $arDM['name'];
                                                        $selected = '';
                                                        if($id_cat == $ar1['id_cat']){
                                                            $selected = 'selected="selected"';
                                                        }
                                                        ?>
                                                        <option value="<?php echo $id_cat;?>" <?php echo $selected ;?> ><?php echo $name;?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hình ảnh</label>
                                                <input type="file" name="hinhanh" class="form-control" placeholder="Chọn ảnh" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ảnh cũ</label>
                                                <?php 
                                                if($ar1['picture'] != ''){
                                                    ?>
                                                    <img src="/files/<?php echo $ar1['picture'] ?>" width="120px" alt="" /> Xóa <input type="checkbox" name="xoa" value="" />
                                                    <?php 
                                                }else{
                                                ?>
                                                    <img src="/files/no-picture.jpg" width="120px" alt="" /> 
                                                <?php 
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả</label>
                                                <textarea rows="4" name="mota" class="ckeditor form-control border-input" placeholder="Mô tả tóm tắt về bạn của bạn"><?php echo $ar1['preview_text']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chi tiết</label>
                                                <textarea rows="6" name="chitiet" class="ckeditor form-control border-input" placeholder="Mô tả chi tiết về bạn của bạn"><?php echo $ar1['detail_text']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-info btn-fill btn-wd" name="sua" value="Sửa" />
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#frmEN").validate({
                                ignore: [],
                                debug:false,
                                rules:{               
                                    "tentin":{
                                        required:true,
                                    },
                                    "mota": {
                                        required: function() 
                                        {
                                            CKEDITOR.instances.mota.updateElement();
                                        },
                                        minlength:10
                                    },
                                    "chitiet": {
                                        required: function() 
                                        {
                                            CKEDITOR.instances.chitiet.updateElement();
                                        },
                                        minlength:10
                                    }
                                },
                                messages:{
                                    "tentin":{
                                        required:"<span style='color:red;font-weight:bold'>-Tên tin không được để trống</span>",
                                    },
                                    "mota":{
                                        required:"<span style='color:red;font-weight:bold'>-Mô tả không được để trống</span>",
                                        minlength:"<span style='color:red;font-weight:bold'>-Mô tả không được ít hơn 10 kí tự</span>"
                                    },
                                    "chitiet":{
                                        required:"<span style='color:red;font-weight:bold'>-Chi tiết không được để trống</span>",
                                        minlength:"<span style='color:red;font-weight:bold'>-Chi tiết không được ít hơn 10 kí tự</span>"
                                    }
                                }
                            });
                        });
                    </script> 
                </div>
            </div>
        </div>

        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php' ;
        ?>