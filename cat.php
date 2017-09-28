+<?php
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
            //đếm số dòng dữ liệu trong csdl
            $id = $_GET['id'];
            $queryTSD = "SELECT COUNT(id_news) AS tongsodong FROM news WHERE id_cat = {$id}";
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
          ?>
            <?php 
              $query1 = "SELECT * FROM category WHERE id_cat = {$id}";
              $result1 = $mysqli->query($query1 );
              $ar1 = mysqli_fetch_assoc($result1);
            ?>
            <h1 class="title" id="title-dm">Tin tức >> <?php echo $ar1['name'];?></h1>
            <?php 
              if($tsd == 0){
                echo "<b>Không có tin!</b>";
              }else{
                  $query = "SELECT * FROM news  WHERE id_cat = {$id} ORDER BY id_news DESC LIMIT {$offset} , {$row_count}";
                  $mysql = $mysqli->query($query);
                  while($arDM  = mysqli_fetch_assoc($mysql)){
                    $id_news = $arDM['id_news'];
                    $name = $arDM['name'];
                    $preview_text = $obj->cutString($arDM['preview_text']);
                    $picture = $arDM['picture'];

                    $new_name = $obj->getUrlRewrite($name);
                    $url = '/' . $new_name . '-' . $id_news . '.html';
            ?>
            <div class="item">
             <h2><h2><a href="<?php echo $url; ?>" title=""><?php echo $name ?></a></h2>
             <?php 
                if($picture != ""){
             ?>
             <img src="/files/<?php echo $picture; ?>" alt="" width="150" height="100" />
             <?php 
                }else{
             ?>
             <img src="/files/no-picture.jpg" alt="" width="185" height="156" />
             <?php 
              }
             ?>
             <p><?php echo $preview_text; ?></p>
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
                  $p_new_name = $obj->getUrlRewrite($ar1['name']);
                  if($current_page > 1 && $sotrang >1){
                    $current_page = $current_page - 1;
                    $p_url = '/danh-muc/'. $p_new_name . '-'. $id . '/p=' . $current_page ;
                    $current_page = $current_page + 1;
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
                    $p_url = '/danh-muc/'. $p_new_name . '-'. $id . '/p=' . $i ;
                ?>
                <?php 
                  if($sotrang != 1){
                ?>
                  <a href="<?php echo $p_url; ?>" <?php echo $active; ?>><?php echo $i; ?></a> 
                <?php 
                    }
                  }
                  if($current_page < $sotrang && $sotrang > 1){
                    $current_page = $current_page + 1;
                    $p_url = '/danh-muc/'. $p_new_name . '-'. $id . '/p=' . $current_page ;
                ?>
                <a href="<?php echo $p_url; ?>">Next</a>
                <?php } ?>
              </div>
     <?php
     require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/footer.php' ;
     ?>