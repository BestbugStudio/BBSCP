<?php
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	session_start();

	header("Cache-Control: no-cache"); 
	header("Pragma: no-cache"); 
	header("Expires: 0");

	include_once dirname(__FILE__).'/../abspath.php';
	include_once ABSOLUTEPATH.'/install/install.php';
	include_once ABSOLUTEPATH.'/admin/utilities/login.php';
	include_once ABSOLUTEPATH.'/utilities/database.php';
	include_once ABSOLUTEPATH.'/config/query.php';

	/* Login Title */
	echo '<head><title>BestBug Studio Control Panel</title>';
?>
	<head>
		<title>BestBug Studio Control Panel</title>
<?	/* Stylesheets */ ?>
		<link rel="stylesheet" type="text/css" href="../framework/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="../framework/jQuery/css/jQuery-UI.min.css"/>
		<link rel="stylesheet" type="text/css" href="./style/default_theme.min.css"/>
		<link rel="stylesheet" type="text/css" href="../framework/datetime-picker/jquery.datetimepicker.css"/>

<?	/* Script pgin */ ?>
		<script type="text/javascript" src="../framework/jQuery/js/jQuery.min.js"></script>
		<script type="text/javascript" src="../framework/jQuery/js/jQuery-UI.min.js"></script>
		<script type="text/javascript" src="../framework/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../framework/datetime-picker/jquery.datetimepicker.js"></script>

	</head>
<?	/*  Copyright  */ ?>
	<div class="well well-sm copyheader">BestBug Studio Control Panel v2.0 &copy <a href="http://www.bestbugstudio.com" target="_blank">BBS</a></div>
	
<?
	$DB = new Database(Install::getInstance());	
	$Q = new Query();
	$Login = new Login($DB,$Q);

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>