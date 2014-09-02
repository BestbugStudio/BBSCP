<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	header_remove();

	echo '<link rel="stylesheet" type="text/css" href="./../framework/bootstrap/css/bootstrap.min.css"/>';

	include_once dirname(__FILE__).'/install.php';
	include_once dirname(__FILE__).'/../utilities/database.php';
	include_once dirname(__FILE__).'/../config/query.php';
	include_once dirname(__FILE__).'/../models/User.php';

	$user_info = array(
			'firstname'=> $_GET['firstname'],
			'lastname' => $_GET['lastname'],
			'nickname' => $_GET['nickname'],
			'password' => sha1($_GET['password']),
			'email'	   => $_GET['email']
		);

	createFirstUser($user_info);
	//redirectToAdminSection();

	function createFirstUser($config_info){
		$_POST['origin'] = "server";
		$_POST['config_info'] = $config_info;

		include_once dirname(__FILE__).'/../models/User.php';

		$DB = new Database(Install::getInstance());
		$Q = new Query();

		$DB->connect();
		
		$info = $_POST['config_info'];
		$User = new User(-1,
						 $info['nickname'],
						 $info['password'],
						 $info['firstname'],
						 $info['lastname'],
						 $info['email'],
						 0);

		$res = $User->addNewData($User);

		$response = json_decode($res,true);

		if($response['Status'] == "OK"){
			echo '<div class="alert alert-success text-center center-block">'.$response['Message'].'</div>';
		}else{
			echo'<div class="alert alert-danger text-center center-block">'.$response['Reason'].'</div>';
		}

	}

	function redirectToAdminSection(){
		die('<script>location.href="'.$_SERVER['HTTP_REFERER'].'admin/"</script>');
	}





	// if(isset($_POST['origin']) && $_POST['origin']=='server'){

	// 	include_once dirname(__FILE__).'/../utilities/database.php';
	// 	include_once dirname(__FILE__).'/../config/query.php';
	// 	include_once dirname(__FILE__).'/../models/User.php';


	// 	$DB = new Database(Install::getInstance());
	// 	$Q = new Query();
		
	// 	$info = $_POST['config_info'];
	// 	$User = new User(-1,
	// 					 $info['nickname'],
	// 					 $info['password'],
	// 					 $info['firstname'],
	// 					 $info['lastname'],
	// 					 $info['email'],
	// 					 0);

	// 	$res = $User->addNewData($User);

	// 	if($res == 1){
	// 		$response = array(
	// 			'Status'=>'OK',
	// 			'Message'=>'User successfully added'
	// 		);
	// 		return json_encode($response);
	// 	}

	// 	$response = array(
	// 		'Status'=>'KO',
	// 		'Reason'=>'Something went wrong with the query'
	// 	);
	// 	return json_encode($response);
	// }
	
	// $response = array(
	// 	'Status' => 'KO',
	// 	'Reason' => 'You tried to access from an illegal place! That\'s wrong!'
	// );
	// return json_encode($response);

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>