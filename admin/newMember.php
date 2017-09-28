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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh sách tin</h4>
                                <?php
                                    if(isset($_POST['msg'])){
                                ?>
                                <p class="category success">Thêm thành công</p>
                                <?php 
                                    }
                                ?>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th style="width:26%" class="text-center">Tên tin</th>
                                    	<th>Danh mục tin</th>
                                    	<th>Người đăng</th>
                                        <th>Ngày đăng</th>
                                        <th>Hình ảnh</th>
                                    	<th>Duyệt</th>
                                    	<th>Chức năng</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $queryTSD = "SELECT COUNT(id_news) AS tongsodong FROM news WHERE id_mem <> 0";
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
                                        $query1 = "SELECT news.*,category.name as cname,member.fullname as mname FROM news INNER JOIN category INNER JOIN member WHERE category.id_cat = news.id_cat and news.id_user = member.id and id_mem <> 0 ORDER BY id_news DESC LIMIT {$offset} , {$row_count}" ;
                                        $result1 = $mysqli->query($query1);
                                        while($ar1 = mysqli_fetch_array($result1)){
                                            $date_create = explode(' ', $ar1['date_create']);
                                            $date_edit = explode(' ', $ar1['date_edit']);
                                            $urlDel = "delNewMem.php?id={$ar1['id_news']}";
                                        ?>
                                        <tr>
                                        	<td><?php echo $ar1['id_news']; ?></td>
                                            <td><a href="edit.php"><?php echo $ar1['name']; ?></a></td>
                                            <td><?php echo $ar1['cname']; ?></td>
                                        	<td><?php echo $ar1['mname']; ?></td>
                                            <td><?php echo $date_create[0] ; ?></td>
                                            <?php 
                                                if($ar1['picture'] != ""){
                                            ?>
                                        	<td><img src="/files/<?php echo $ar1['picture']; ?>" alt="" width="100px" /></td>
                                            <?php
                                                }else{
                                            ?>
                                            <td><img src="/files/no-picture.jpg" alt="" width="100px" /></td>
                                            <?php 
                                            }
                                            ?>
                                            <td  class="id-news-<?php echo $ar1['id_news']; ?>">
                                                <?php 
                                                    if ($ar1['active'] == 0){
                                                ?>
                                                <a href="javascript:void(0)" onclick="changeActive(<?php echo $ar1['id_news'];?>, 1)">
                                                    <img src="/templates/admin/assets/img/active.gif" alt="" />
                                                </a>
                                                <?php
                                                    }else{
                                                ?>
                                                <a href=" javascript:void(0)" onclick="changeActive(<?php echo $ar1['id_news'];?>, 0)">
                                                    <img src="/templates/admin/assets/img/deactive.gif" alt="" />
                                                </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        	<td>
                                        		<a href="<?php echo $urlDel; ?>" onclick="return xacNhanXoa()"><img src="/templates/admin/assets/img/del.gif" alt="" /> Xóa</a>
                                        	</td>
                                        </tr>
                                        <?php 
                                            }}
                                        ?>
                                    </tbody>
                                </table>

								<div class="text-center">
                                    <ul class="pagination">
                                    <?php
                                        if($sotrang > 1 && $current_page > 1){
                                    ?>
                                        <li>
                                            <a href="newMember.php?page=<?php echo $current_page-1; ?>"  title=""><span>Prev</span>
                                            </a>
                                        </li>
                                       <?php 
                                        }
                                       for($i = 1; $i <= $sotrang ; $i++){
                                        if($i == $current_page){
                                            $active = 'class="active"';
                                        }else{
                                            $active = null;
                                        }
                                        ?>
                                        <li <?php echo $active; ?>>
                                            <a href="newMember.php?page=<?php echo $i; ?>"  title="">
                                                <?php echo $i;?>
                                            </a>
                                        </li>
                                        <?php 
                                            }
                                            if($sotrang > 1 && $current_page < $sotrang){
                                        ?>
                                        <li>
                                            <a href="newMember.php?page=<?php echo $current_page+1; ?>"  title=""><span>Next</span>
                                            </a>
                                        </li>
                                        <?php
                                            }
                                        ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function changeActive(id_news, check){
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    cache: false,
                    data: {
                        acheck : check,
                        aid : id_news
                    },
                    success: function(data){
                        $('.id-news-'+id_news).html(data);
                    },
                    error: function (){
                        alert('Có lỗi xảy ra');
                    }
                });     
            }
        </script>   
<script type="text/javascript">
    function xacNhanXoa(){
        var x = confirm('Bạn có chắc muốn xóa');
        if(x){
            return true;
        }else{
            return false;
        }
    }
</script>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php' ;
?>
        