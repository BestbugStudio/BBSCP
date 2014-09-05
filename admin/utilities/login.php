<?php
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	include_once dirname(__FILE__).'/main.php';
	include_once dirname(__FILE__).'/../../models/User.php';

	class Login{

		private $DB;
		private $Q;

		public function __construct($DB,$Q){
			$this->DB = $DB;
			$this->Q = $Q;

			if(!isset($_POST['password']))
				$this->printlogin();
			elseif(isset($_POST['password']))
				$this->loginhandler($DB);
		}

		public function printlogin(){

			if(isset($_SESSION['access'])){
				$this->mainCallback();
			}else{
				echo '
					<form class="loginform" method="POST" action="#">
						<div class="input-group">
							<span class="input-group-addon">Username</span>
							<input type="text" class="form-control" name="username"></input>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon">Password</span>
							<input type="password" class="form-control" name="password"></input>
						</div>
						<br>
						<button class="btn" type="submit" value="Login">Log In</button>
					</form>';
			}
		}

		public function loginhandler(){
			$this->DB->connect();

			$username = $this->DB->sanitize($_POST['username']);
			$password = sha1($this->DB->sanitize($_POST['password']));
 			
			$User = User::userLogger($username,$password);

			$logQuery = $this->Q->login($User->getObjectData());
			$result = $this->DB->startQuery($logQuery);
			$result = $this->DB->returnFirstRow($result);

			if($result != ""){
				$_SESSION['access'] = session_id();
				$_SESSION['nickname'] = $result['nickname']; 
				$this->mainCallback();
			}else{
				$this->printlogin();
				echo '<div class="alert alert-danger alert-dismissable wronglog">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						wrong username or password
					</div>';
			}
		}

		private function mainCallback(){
			$Main = new Main();
		}
	}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>