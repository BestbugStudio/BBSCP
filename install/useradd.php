<?
	include_once dirname(__FILE__).'/../utilities/database.php';
	include_once dirname(__FILE__).'/../install/install.php';
	include_once dirname(__FILE__).'/../config/query.php';

	$DB = new Database(Install::getInstance());
	$Q = new Query();

	$config_info = $_POST['config_info'];

	$DB->connect();
	$query = $Q->addNewUser($config_info['nickname'],
							$config_info['password'],
							$config_info['firstname'],
							$config_info['lastname'],
							$config_info['email'],
							0);
	//$res=$DB->startQuery($query);

	echo "<br>".$query."</br>";

	var_dump($res);


	print_r("<br>HEY, I'm in the useradd experience</br>");
 	echo $_POST['msg'];
 	//echo $_POST['config_info'];

?>