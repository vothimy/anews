<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<?php 
	session_destroy();
	//unset($_SESSION['arUser']);
	header("location:login.php");
?>

<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/cnews/templates/admin/inc/footer.php';
?>