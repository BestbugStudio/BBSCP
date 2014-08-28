<?php
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	session_start();

	header("Cache-Control: no-cache"); 
	header("Pragma: no-cache"); 
	header("Expires: 0");

	include_once dirname(__FILE__).'/install/install.php';
	include_once dirname(__FILE__).'/utilities/database.php';
	include_once dirname(__FILE__).'/config/query.php';


?>
	<head>
<?	/* Stylesheets */ ?>
		<link rel="stylesheet" type="text/css" href="./framework/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="./framework/jQuery/css/jQuery-UI.min.css"/>
		<link rel="stylesheet" type="text/css" href="./style/default_theme.min.css"/>
		<link rel="stylesheet" type="text/css" href="./framework/datetime-picker/jquery.datetimepicker.css"/>

<?	/* Script pgin */ ?>
		<script type="text/javascript" src="./framework/jQuery/js/jQuery.min.js"></script>
		<script type="text/javascript" src="./framework/jQuery/js/jQuery-UI.min.js"></script>
		<script type="text/javascript" src="./framework/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./framework/datetime-picker/jquery.datetimepicker.js"></script>

<?

	$InstallationInstance = Install::getInstance();

	if(json_decode($Inst->checkInstallation(), true)['Status'] == 'KO'){
		echo '<title> WELCOME! </title>';
		$InstallationInstance->startInstallation();
		die;		
	}

?>
		<title> <? $InstallationInstance->getSitename(); ?> </title>
	</head>
	
<?
	$DB = new Database($InstallationInstance);
	echo "prova";

	// Call to sitegenerator functions

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>