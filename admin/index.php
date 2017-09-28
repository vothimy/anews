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
                            <div class="content">
                                <div class="col-md-3">
                                    <a href="addCat.php" class="dashboard-module">
                                        <img src="/templates/admin/assets/img/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
                                        <span>Thêm danh mục</span>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="addFr.php" class="dashboard-module">
                                        <img src="/templates/admin/assets/img/Crystal_Clear_files.gif" width="64" height="64" alt="edit" />
                                        <span>Thêm tin</span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="h2">QUẢN TRỊ HỆ THỐNG</h2>
                                    <div class="module-body">
                                        <p class="p">
                                            <strong>Phần mềm</strong> được viết trên nền tảng PHP&MySQL <br />
                                            <strong>Học viên thực hiện: </strong>VÕ THỊ MỸ<br />
                                            <strong>Email: </strong>thimyvo18@gmail.com<br /> 
                                            <strong>Phone: </strong>0905 013 498<br />
                                        </p>
                                    </div>
                                </div>
                                <div style="clear: both"></div>
                            </div> <!-- End .grid_7 -->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php';
?>
