<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/function/checklogin.php';
?>
<?php 
	$id = $_GET['id'];
	$query = "DELETE FROM category WHERE id_cat = {$id}";
	$mysqli->query($query);
	header('location:indexCat.php?msg=Xóa thành công');
	exit();
?>
<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>