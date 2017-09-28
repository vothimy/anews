<div class="menu">
  <ul >
    <li style="margin-bottom: 20px !important;"><a href="/" class="active"><span>Trang chủ</span></a></li>
    <?php 
    if(isset($_SESSION['arU']['username'])){
      ?>
      <li><a href="/them-tin"><span>Đăng tin</span></a></li>
      <?php 
    }
    ?>
    <?php 
    if(!isset($_SESSION['arU']['username'])){
      ?>
      <li>
        <a href="/dang-nhap"><span>Đăng nhập</span></a>
      </li>
      <li><a href="/dang-ki"><span>Đăng kí</span></a></li>
      <?php 
       }
      ?>
    <?php 
    if(isset($_SESSION['arU']['username'])){
      ?>
      <li>
      <a href="logout.php"><span>Đăng xuất</span></a>  
      </li>
      <?php 
      } 
      ?>
      <li style="margin-top:20px;">
      <input type="text" name=""> 
      <input type="submit" value="tìm kiếm">
      </li>
    </ul> 
  </div>