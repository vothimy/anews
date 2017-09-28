<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/header.php' ;
?>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.php"><span>Vina</span>Enter<br />
          <small>Đã Học Là Làm Được</small></a></h1>
      </div>
      <div class="clr"></div>
      <div class="menu">
        <ul>
          <li><a href="index.php" class="active"><span>Trang chủ</span></a></li>
          <li><a href="add.php"><span>Đăng tin</span></a></li>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
  </div>
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
                    if($num == 1){
                      if($hinhanh == ''){
                        $sql = "INSERT INTO news(name,id_cat,preview_text,detail_text,date_create,id_user,id_mem,active)
                        VALUES ('{$tentin}' ,{$danhmuc} ,'{$mota}','{$chitiet}','{$date}',{$_SESSION['arU']['id']},1,1)";
                        $ketqua = $mysqli->query($sql);
                        if($ketqua){
                          header("location:index.php?msg=Thêm thành công");
                          exit();//die;
                        }else{
                          echo "Có lỗi khi thêm tin";
                        }
                      }else{
                        $tenhinhmoi = $obj1->uploadFile($hinhanh);
                        if($tenhinhmoi != false){
                          $sql2 = "INSERT INTO news(name,id_cat,preview_text,detail_text,date_create,id_user,picture,id_mem,active)
                          VALUES ('{$tentin}' ,{$danhmuc} ,'{$mota}','{$chitiet}','{$date}',{$_SESSION['arU']['id']},'{$tenhinhmoi}',1,1)  ";
                          $ketqua2 = $mysqli->query($sql2);
                          if($ketqua2){
                            header("location:index.php?msg=Thêm thành công");
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
  <div class="body">
    <div class="body_resize">
      <div class="left">
        <h2>Đăng tin</h2>
        <form action="#" method="post" id="contactform" enctype="multipart/form-data">
          <ol>
            <li>
              <label for="name">Tên tin*</label>
              <input id="name" name="tentin" class="text" required="" style="width:350px; height:25px;color: #000;"/>
            </li>
            <li>
              <label>Danh mục tin</label>
              <select name="danhmuc" class="text" style="width:150px; height:30px;color: #000;">
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
            </select>
            </li>
            <li>
               <label>Hình ảnh</label>
                <input type="file" name="hinhanh" class="form-control" />
            </li>
            <li>
              <label for="preview_text">Mô tả*</label>
              <textarea id="preview_text" name="mota" rows="8" cols="10" required=""></textarea>
            </li>
            <li>
              <label for="detail_text">Chi tiết*</label>
              <textarea id="detail_text" name="chitiet" rows="10" cols="50" required=""></textarea>
            </li>
            
            <li class="buttons">
              <input type="submit" name="them" id="imageField"  value="Đăng tin" class="send" />
              <div class="clr"></div>
            </li>
          </ol>
        </form>
      </div>
      <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/rightbar.php' ;
      ?>
      <div class="clr"></div>
    </div>
  </div>
<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/footer.php' ;
?>

