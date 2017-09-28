<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/connect.php';
	$active = $_POST['acheck'];
	$id = $_POST['aid'];
?>
<?php
		$query = "UPDATE news SET active = '{$active}' WHERE id_news = {$id} LIMIT 1";
	    $result = $mysqli->query($query);
	    if ($active == 0){
?>
	<a href="javascript:void(0)" onclick="changeActive(<?php echo $id?>, 1)">
	    <img src="/templates/admin/assets/img/active.gif" alt="" />
	</a>
<?php
    	} else{
?>
	<a href="javascript:void(0)" onclick="changeActive(<?php echo $id?>, 0)">
	    <img src="/templates/admin/assets/img/deactive.gif" alt="" />
	</a>
<?php
    	}
?>