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
          <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/navbar.php' ; ?>
          <div class="clr"></div>
        </div>
      </div>
      <div class="body">
        <div class="body_resize">
          <div class="left">
            <?php 
              $queryTSD = "SELECT COUNT(id_news) AS tongsodong FROM news";
              $resultTSD = $mysqli->query($queryTSD);
              $arTSD = mysqli_fetch_assoc($resultTSD);
              $tsd = $arTSD['tongsodong'];
              $row_count = ROW_COUNT;
              $sotrang = ceil($tsd / $row_count);
              $current_page = 1;
              if(isset($_GET['page'])){
                  $current_page = $_GET['page'];
              }
              $offset = ($current_page - 1) * $row_count;
              if($tsd == 0){
                  echo '<h2 style="color:red">Bạn chưa có tin tức nào!</h2>';
              }else{
              $query1 = "SELECT * FROM news WHERE active = 0 ORDER BY id_news DESC LIMIT {$offset} , {$row_count}";
              $result1 = $mysqli->query($query1);
              while($ar1 = mysqli_fetch_array($result1)){
                $new_name = convertUtf8ToLatin($ar1['name']);
                $url = '/' . $new_name . '-' .$ar1['id_news'] . '.html';
              ?>
           <div class="item">
             <h2><h2><a href="<?php echo $url; ?>" title=""><?php echo $ar1['name'] ?></a></h2>
             <?php  
                if($ar1['picture'] != ""){
             ?>
             <img src="/files/<?php echo $ar1['picture']; ?>" alt="" width="150" height="100" />
             <?php 
                }else{
             ?>
             <img src="/files/no-picture.jpg" alt="" width="150" height="100" />
             <?php 
              }
             ?>
             <p><?php echo $ar1['preview_text'] ?></p>
           </div>
             <div class="clr"></div>

           <?php 
            }
          }
           ?>
         </div>
         <?php
         require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/rightbar.php' ;
         ?>
         <div class="clr"></div>
       </div>

     </div>
     <div class="paginator">
        <?php     
          if($sotrang >1 && $current_page > 1){
            $current_page = $current_page - 1;
            $p_url = '/tin-tuc-p=' . $current_page;
            $current_page = $current_page + 1;//giữ lại trang cũ nếu k thực hiện 
        ?>
          <a href="<?php echo $p_url; ?>" >Prev</a>
        <?php
          }
          for($i = 1; $i <= $sotrang ; $i++){
            if($i == $current_page){
              $active = 'class="active"';
            }else{
              $active = null;
            }
            $p_url = '/tin-tuc-p=' . $i;
        ?>
        <a href="<?php echo $p_url; ?>" <?php echo $active; ?>><?php echo $i; ?></a>
        <?php 
          }
          if($sotrang > 1 && $current_page < $sotrang){
            $current_page = $current_page + 1;
            $p_url = '/tin-tuc-p=' . $current_page;
        ?>
        <a href="<?php echo $p_url; ?>">Next</a>
        <?php } ?>
      </div>
     <?php
     require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/footer.php' ;
     ?>