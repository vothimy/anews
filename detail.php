<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/public/inc/header.php' ;
?>
<body>
  <div class="main">
    <div class="header">
      <div class="header_resize">
        <div class="logo">
          <h1><a href="/"><span>Vina</span>Enter<br />
            <small>Đã Học Là Làm Được</small></a></h1>
          </div>
          <div class="clr"></div>
          <div class="menu">
            <ul>
              <li><a href="/" class="active"><span>Trang chủ</span></a></li>
              <li><a href="add.php"><span>Đăng tin</span></a></li>
            </ul>
          </div>
          <div class="clr"></div>
        </div>
      </div>
      <div class="body">
        <div class="body_resize">
          <div class="left">
            <?php
            if($_GET['id'] != NULL){
              $id = $_GET['id'];
            }else{
              header("location:index.php");
              exit();
            }
            $query1 = "SELECT * FROM news  WHERE id_news = {$id} LIMIT 1";
            $mysql1 = $mysqli->query($query1);
            $arDM  = mysqli_fetch_assoc($mysql1);
            $id_cat = $arDM['id_cat'];
            $name = $arDM['name'];
            $detail_text = $arDM['detail_text'];
            ?>
            <h3><?php echo $name; ?></h3>
            <div class="item-detail">
             <p><?php echo $detail_text; ?></p>
           </div>
           <!--  -->
           <?php
           $query2 = "SELECT * FROM news  WHERE id_news <> {$id} AND id_cat = {$id_cat} ORDER BY id_news DESC LIMIT 2";
           $mysql2 = $mysqli->query($query2);
           $num = mysqli_num_rows($mysql2);
           if($num != 0){
            ?>
            <h2 class="title" style="margin-top:30px;color:#BBB">Tin tức liên quan</h2>
            <div class="items-new">
              <?php
              while($arnews = mysqli_fetch_assoc($mysql2)){
                $id_news = $arnews['id_news'];
                $name = $arnews['name'];
                $preview_text = $obj->cutString($arnews['preview_text']);
                $picture = $arnews['picture'];
                $new_name = $obj->getUrlRewrite($name);
                $url = '/' . $new_name . '-' . $id_news . '.html';
                ?>
                <h2>
                  <a href="<?php echo $url;?>" title="<?php echo $name;?>"><?php echo $name;?></a>
                </h2>
                <div class="item">
                  <?php 
                  if($picture != ''){
                    ?>
                    <a href="<?php echo $url;?>"><img src="files/<?php echo $picture;?>" alt="<?php echo $name;?>" width="150" height="100" ></a>
                    <?php 
                  }
                  ?>
                  <p><?php echo $preview_text . '...';?></p>
                  <div class="clr"></div>
                </div>
                <?php
              }
              ?>
            </div>
            <?php
          }
          ?>
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
