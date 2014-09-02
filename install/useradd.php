<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	if(isset($_POST['origin']) && $_POST['origin']=='server'){

		include_once dirname(__FILE__).'/../utilities/database.php';
		include_once dirname(__FILE__).'/../install/install.php';
		include_once dirname(__FILE__).'/../config/query.php';
		include_once dirname(__FILE__).'/../models/User.php';


		$DB = new Database(Install::getInstance());
		$Q = new Query();
		
		$info = $_POST['config_info'];
		$User = new User(-1,
						 $info['nickname'],
						 $info['password'],
						 $info['firstname'],
						 $info['lastname'],
						 $info['email'],
						 0);

		$res = $User->addNewData($User);

		if($res == 1){
			$response = array(
				'Status'=>'OK',
				'Message'=>'User successfully added'
			);
			return json_encode($response);
		}

		$response = array(
			'Status'=>'KO',
			'Reason'=>'Something went wrong with the query'
		);
		return json_encode($response);
	}
	
	$response = array(
		'Status' => 'KO',
		'Reason' => 'You tried to access from an illegal place! That\'s wrong!'
	);
	return json_encode($response);

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>