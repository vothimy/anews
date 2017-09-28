<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>

<?php 
	//session_destroy();
	unset($_SESSION['arU']);
	header("location:index.php");
?>

<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>