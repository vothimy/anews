<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/function/connect.php' ;
	require_once $_SERVER['DOCUMENT_ROOT'] . '/function/defines.php' ;
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/re.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LibraryString.php' ;
	require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LibraryFile.php' ;
	$obj1 = new LibraryFile();
	$obj = new LibraryString();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>VinaEnter - Đã Học Là Làm Được</title>
	<link href="/templates/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/templates/admin/assets/css/animate.min.css" rel="stylesheet"/>
    <link href="/templates/admin/assets/css/paper-dashboard.css" rel="stylesheet"/>

    <link href="/templates/public/style.css" rel="stylesheet" />
    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="/templates/admin/assets/css/themify-icons.css" rel="stylesheet">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href="/templates/public/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/templates/public/js/cufon-yui.js"></script>
	<script type="text/javascript" src="/templates/public/js/cufon-yui.js"></script>
	<script type="text/javascript" src="/templates/public/js/arial.js"></script>
	<script type="text/javascript" src="/library/jquery/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/library/ckeditor/ckeditor.js"></script>
	
</head>