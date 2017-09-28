<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/function/checklogin.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LibraryFile.php';
$obj = new LibraryFile();
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
                <h4 class="title">Thêm tin tức vào danh sách</h4>
              </div>
              <div class="content">
               <?php
                if(isset($_POST['them'])){
                  $time = time();
                  $date = date("Y-m-d H:i:s");
                  $tentin = $mysqli->real_escape_string($_POST['tentin']);
                  $danhmuc = $_POST['danhmuc'];
                  $mota = $_POST['mota'];
                  $chitiet = $_POST['chitiet'];
                  $hinhanh = $_FILES['hinhanh']['name'];
                  $query = "SELECT * FROM news";
                  $result = $mysqli->query($query);
                  if($tentin == '' || $mota == '' || $chitiet == ''){
                    echo "<b>Không được nhập vào rỗng!</b>";
                  }else{
                    $num = 1;
                    while($ar = mysqli_fetch_assoc($result)){
                      if($tentin == $ar['name']){
                        $num = 2;
                        echo '<p style="color:red">Tin này đã có!</p>';
                      }
                    }
                    $queryUser = "SELECT * FROM users WHERE username like '{$_SESSION['arUser']['username']}' LIMIT 1 ";
                    $resultUser = $mysqli->query($queryUser);
                    $arU = mysqli_fetch_assoc($resultUser);
                    if($num == 1){
                      if($hinhanh == ''){
                        $sql = "INSERT INTO news(name,id_cat,preview_text,detail_text,date_create,id_user)
                        VALUES ('{$tentin}' ,{$danhmuc} ,'{$mota}','{$chitiet}','{$date}',{$arU['id_user']})";
                        $ketqua = $mysqli->query($sql);
                        if($ketqua){
                          header("location:indexNews.php?msg=Thêm thành công");
                          exit();//die;
                        }else{
                          echo "Có lỗi khi thêm tin";
                        }
                      }else{
                        $tenhinhmoi = $obj->uploadFile($hinhanh);
                        if($tenhinhmoi != false){
                          $sql2 = "INSERT INTO news(name,id_cat,preview_text,detail_text,date_create,id_user,picture)
                          VALUES ('{$tentin}' ,{$danhmuc} ,'{$mota}','{$chitiet}','{$date}',{$arU['id_user']},'{$tenhinhmoi}')  ";
                          $ketqua2 = $mysqli->query($sql2);
                          if($ketqua2){
                            header("location:indexNews.php?msg=Thêm thành công");
                          }else{
                            echo "Lỗi khi thêm tin có hình";
                          }
                        }else{
                          echo "upload thất bại";
                        }
                      }
                    }
                  }
                }
                ?>
              <form action="" method="POST" enctype="multipart/form-data" id="frmAN">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Tên tin(*)</label>
                      <input type="text" name="tentin" class="form-control border-input" value="<?php if(isset($_POST['them'])){ echo $_POST['tentin'] ;} ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                   <div class="form-group">
                    <label>Danh mục tin</label>
                    <select name="danhmuc" class="form-control border-input">
                     <?php
                      $queryDM = "SELECT * FROM category ";
                      $mysql = $mysqli->query($queryDM);
                      while($arDM = mysqli_fetch_assoc($mysql)){
                        $id_cat = $arDM['id_cat'];
                        $name = $arDM['name'];
                        ?>
                        <option value="<?php echo $id_cat;?>"><?php echo $name;?></option>
                        <?php
                      }
                      ?>
                      <option value="<?php echo $fl_id; ?>"><?php echo $fl_name; ?></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Hình ảnh</label>
                  <input type="file" name="hinhanh" class="form-control" />
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Mô tả(*)</label>
                  <textarea rows="4" name="mota" class="form-control border-input ckeditor" placeholder="Mô tả tóm tắt tin "><?php if(isset($_POST['them'])){ echo $_POST['mota'] ;} ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Chi tiết(*)</label>
                  <textarea rows="6" name="chitiet" class="form-control border-input ckeditor" placeholder="Mô tả chi tiết tin"><?php if(isset($_POST['them'])){ echo $_POST['chitiet'] ;} ?></textarea>
                </div>
              </div>
            </div>
            <div class="text-center">
              <input type="submit" name="them" class="btn btn-info btn-fill btn-wd" value="Thêm"/>
            </div>
            <div class="clearfix"></div>
          </form>
          <script type="text/javascript">
                  $(document).ready(function(){
                    $("#frmAN").validate({
                      ignore: [],
                      debug:false,
                      rules:{               
                        "tentin":{
                          required:true,
                        },
                        "mota":{
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
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php';
?>
