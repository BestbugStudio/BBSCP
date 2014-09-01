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
	
	//redirectToAdminSection();


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
		$url = 'localhost/~federicomaggi/BBSCP/install/useradd.php';

		$fields = 'config_info='.$config_info;
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec ($ch);

		echo "ehiehi:<br>";
		var_dump($response);
		print_r($response);

		curl_close ($ch);

		// SOLUZIONE CURL
		// $fields = array(
		// 			'__VIEWSTATE'=>urlencode($state),
		// 			'__EVENTVALIDATION'=>urlencode($valid),
		// 			'btnSubmit'=>urlencode('Submit'),
		// 			'msg'=>'lol'
		//         );

		// //url-ify the data for the POST
		// foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		// rtrim($fields_string,'&');

		// //open connection
		// $ch = curl_init();

		// //set the url, number of POST vars, POST data
		// curl_setopt($ch,CURLOPT_URL,$url);
		// curl_setopt($ch,CURLOPT_POST,count($fields));
		// curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

		// echo 'there goes the result<br>';
		// //execute post
		// $result = curl_exec($ch);
		// print $result;
		
		// SOLUZIONE NO CURL
		// $data = array('Origin' => 'myServer', 'config_info' => $config_info);

		// // use key 'http' even if you send the request to https://...
		// $options = array(
		//     'http' => array(
		//         'header'  => "Content-type: application/x-www-form-urlencoded",
		//         'method'  => 'POST',
		//         'content' => http_build_query($data),
		//     ),
		// );
		// $context  = stream_context_create($options);
		// $result = file_get_contents($url, false, $context);

		// var_dump($result);

	}

	function redirectToAdminSection(){
		die('<script>location.href="'.$_SERVER['HTTP_REFERER'].'/admin/"</script>');
	}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>