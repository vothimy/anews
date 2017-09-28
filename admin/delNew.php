<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/function/checklogin.php';
?>
<?php 
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}else{
		header("location:indexNews.php");
		exit();
	}
	$query ="SELECT picture FROM news WHERE id_news = {$id}";
	$result = $mysqli->query($query);
	$arNew = mysqli_fetch_assoc($result);
	$picture = $arNew['picture'];

	$queryDel = "DELETE FROM news WHERE id_news = {$id} LIMIT 1";
	$mysqli->query($queryDel);
	//xóa file
	unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $picture);
	
	header('location:indexNews.php?msg=Xóa thành công');
	exit();
?>
<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>