<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

Class Install{

	private static $instance = null;
	private $sitename, $dbname, $dbuser, $dbpwd, $dbhost, $dbport;

	private function __construct(){
		include_once dirname(__FILE__).'/../abspath.php';
		$config = simplexml_load_file( ABSOLUTEPATH .'/config/mainconfig.xml');

		$this->sitename = $config->sitename;

		$this->dbname 	= $config->dbproperties->dbname;
		$this->dbuser 	= $config->dbproperties->dbuser;
		$this->dbpwd 	= $config->dbproperties->dbpwd;
		$this->dbhost 	= $config->dbproperties->dbaddr->dbhost;
		$this->dbport 	= (int)$config->dbproperties->dbaddr->dbdbport;
	}

	public function checkInstallation(){
		if($this->dbname == ""){
			return json_encode(array('Status'=>'KO'));
		}else
			return json_encode(array('Status'=>'OK','sitename'=>$this->sitename));
	}

	public function startInstallation(){
		echo '
			<div class="container-fluid">
				<section id="present">
					<div class="row">
						<div class="text-center">
							<br><strong>Welcome</strong><br>This is the Installation procedure of Bestbug Studio Control Panel.<br><br><strong>STEP 1</strong><br>Please enter your database information!<br><span style="font-size:10px;">You have to create a user in mysql before doing this step. We\'ll then import the database.</span>
						</div>
					</div>
				</section>
				<br><br>
				<section id="databaseform">
					<div class="row">
						<div class="col-md-offset-3 col-md-6 col-xs-12" style="border-radius:5px; border:1px solid black; background-color: #aa6600; ">
							<form role="form" id="installationform" action="install/createdatabase.php" method="post">
							<br>
								<div class="text-center"><strong>Site information</strong></div>

								<div class="form-group col-md-12 col-xs-12">
									<label for="sitename">Site name</label>
									<input type="text" class="form-control" name="sitename" id="sitename" placeholder="enter the name of your website">
								</div>
								
								<div class="text-center"><strong>Database information</strong></div>

								<div class="form-group col-md-12 col-xs-12">
									<label for="dbname">Database name</label> 
									<input type="text" class="form-control" name="dbname" id="dbname" placeholder="Enter the name of the database">
								</div>

								<div class="form-group col-md-6 col-xs-12">
									<label for="dbuser">Database user</label>
									<input type="text" class="form-control" name="dbuser" id="dbuser" placeholder="Enter database user">
								</div>

								<div class="form-group col-md-6 col-xs-12">
									<label for="dbpwd">Database password</label>
									<input type="text" class="form-control" name="dbpwd" id="dbpwd" placeholder="Enter database password">
								</div>

								<div class="form-group col-md-8 col-xs-12">
									<label for="dbhost">Database host</label>
									<input type="text" class="form-control" name="dbhost" id="dbhost" placeholder="Enter database host server">
								</div>

								<div class="form-group col-md-4 col-xs-12">
									<label for="dbport">Database port</label>
									<input type="text" class="form-control" name="dbport" id="dbport" placeholder="Enter database port">
								</div>

								<button type="submit" class="btn btn-default center-block" style="background-color:#C67171;color:black"><strong>INSTALL!</strong></button>
							</form>
							<br>
						</div>
					</div>
				</section>
			</div>';
	}

	public static function getInstance(){
		if(self::$instance == null){
			$c = __CLASS__;
			self::$instance = new Install();
		}
		return self::$instance;
	}

	public function getSitename(){
		return $this->sitename;
	}

	public function getDBInfo(){
		return array('dbname' => $this->dbname,
					 'dbuser' => $this->dbuser,
					 'dbpwd'  => $this->dbpwd,
					 'dbhost' => $this->dbhost,
					 'dbport' => $this->dbport);
	}
}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>