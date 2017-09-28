<div class="sidebar" data-background-color="white" data-active-color="danger">
   <div class="sidebar-wrapper">
    <div class="logo">
        <a href="http://vinaenter.edu.vn" class="simple-text">AdminCP</a>
    </div>

    <ul class="nav">
       <li>
        <a href="indexCat.php">
            <i class="ti-map"></i>
            <p>Danh mục tin tức</p>
        </a>
    </li>
    <li class="active">
        <a href="indexNews.php">
            <i class="ti-view-list-alt"></i>
            <p>Danh sách tin tức</p>
        </a>
    </li>
    <li>
        <a href="indexUser.php">
            <i class="ti-panel"></i>
            <p>Danh sách người dùng</p>
        </a>
    </li>
    <?php 
    if(isset($_SESSION['arUser']['username'])){
        if($_SESSION['arUser']['username'] == "admin"){
    ?>
    <li>
        <a href="newMember.php">
            <i class="ti-view-list-alt"></i>
            <p>Tin duyệt</p>
        </a>
    </li>
    <?php 
            }
        }
    ?>
</ul>
</div>
</div>