<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	echo '<link rel="stylesheet" type="text/css" href="./../framework/bootstrap/css/bootstrap.min.css"/>';

	include_once dirname(__FILE__).'/install.php';
	include_once dirname(__FILE__).'/../utilities/database.php';
	include_once dirname(__FILE__).'/../config/query.php';
	include_once dirname(__FILE__).'/../models/User.php';

	$user_info = array(
			'firstname'=> $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'nickname' => $_POST['nickname'],
			'password' => sha1($_POST['password']),
			'email'	   => $_POST['email']
		);

	createFirstUser($user_info);
	sendconfirmmail($user_info);
	redirectToAdminSection();

	function createFirstUser($user_info){
		include_once dirname(__FILE__).'/../models/User.php';

		$DB = new Database(Install::getInstance());
		$Q = new Query();

		$DB->connect();
		
		$User = new User(-1,
						 $user_info['nickname'],
						 $user_info['password'],
						 $user_info['firstname'],
						 $user_info['lastname'],
						 $user_info['email'],
						 0);

		$res = $User->addNewData($User);

		$response = json_decode($res,true);

		if($response['Status'] == "OK"){
			echo '<div class="alert alert-success text-center center-block">'.$response['Message'].'</div>';
		}else{
			echo '<div class="alert alert-danger text-center center-block">'.$response['Reason'].'</div>';
		}
	}

	function sendconfirmmail($user_info){
		//TODO
	}

	function redirectToAdminSection(){
		die('<script>location.href="'.$_SERVER['HTTP_REFERER'].'/../../admin/"</script>');
	}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>