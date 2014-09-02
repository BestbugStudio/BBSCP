<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	echo '<link rel="stylesheet" type="text/css" href="./../framework/bootstrap/css/bootstrap.min.css"/>';

	include_once dirname(__FILE__).'/install.php';
	include_once dirname(__FILE__).'/../utilities/database.php';
	include_once dirname(__FILE__).'/../config/query.php';

	$config_info = array(
			'sitename' => $_POST['sitename'],
			'firstname'=> $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'nickname' => $_POST['nickname'],
			'password' => sha1($_POST['password']),
			'email'	   => $_POST['email'],
			'dbname'   => $_POST['dbname'],
			'dbuser'   => $_POST['dbuser'],
			'dbpwd'	   => $_POST['dbpwd'],
			'dbhost'   => $_POST['dbhost'],
			'dbport'   => $_POST['dbport']
		);

	var_dump($config_info);

	saveDataInConfigXML($config_info);

	installDatabase($config_info);
	
	createFirstUser($config_info);
	
	redirectToAdminSection();


	/* Used functions */

	function saveDataInConfigXML($config_info){
		$doc = new DOMDocument('1.0');
		$xml = simplexml_load_file('../config/mainconfig.xml') or die("{'status':'KO','reason':'File not found during Write!'");
		$sxe = new SimpleXMLElement($xml->asXML());

		$sxe->sitename = $config_info['sitename'];
		$sxe->dbproperties->dbname = $config_info['dbname'];
		$sxe->dbproperties->dbuser = $config_info['dbuser'];
		$sxe->dbproperties->dbpwd  = $config_info['dbpwd'];
		$sxe->dbproperties->dbaddr->dbhost = $config_info['dbhost'];
		$sxe->dbproperties->dbaddr->dbport = $config_info['dbport'];
		
		$doc->preserveWhiteSpace = false;
		$doc->loadXML($sxe->asXML());
		$doc->formatOutput = true;
		$doc->save('../config/mainconfig.xml');
	}

	function installDatabase($config_info){
		$Install = Install::getInstance();
		$sqlscript = str_replace("__DBNAME__", $config_info['dbname'], file_get_contents('../config/bbscp-base-db.sql'));
		$connection = mysqli_connect($config_info['dbhost'],$config_info['dbuser'],$config_info['dbpwd']) or die('{"Status":"KO", "Reason":"Unable to connect! || '.mysqli_error($this).'", "Err.no":"'.mysqli_errno($this).'"}');	

		if(mysqli_multi_query($connection, $sqlscript)){
			echo '<div class="alert alert-success text-center center-block">Database successfully created</div>';
			mysqli_close($connection);	
		}else{
			die('<div class="alert alert-danger text-center center-block">ERROR IMPORTING DATABASE</div>');
		}
	}

	function createFirstUser($config_info){
		$_POST['origin'] = "server";
		$_POST['config_info'] = $config_info;

		//$jSonresponse = include './useradd.php';

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



		// $response = json_decode($jSonresponse,true);

		// if($response['Status'] == "OK"){
		// 	echo '<div class="alert alert-success text-center center-block">'.$response['Message'].'</div>';
		// }else{
		// 	echo'<div class="alert alert-danger text-center center-block">'.$response['Reason'].'</div>';
		// }

	}

	function redirectToAdminSection(){
		die('<script>location.href="'.$_SERVER['HTTP_REFERER'].'admin/"</script>');
	}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>