<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/function/checklogin.php';
?>
<?php 
	if($_SESSION['arUser']['id_user'] == 1){
		$id = $_GET['id'];
		if($id == 1){
			header('location:indexUser.php?msg=Không thể xóa admin');
			exit();
		}
		$query = "DELETE FROM users WHERE id_user = {$id}";
		$mysqli->query($query);
		header('location:indexUser.php?msg=Xóa thành công');
		exit();
	}else{
		header("location:indexUser.php");
	}
?>
<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>