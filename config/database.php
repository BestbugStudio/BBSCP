<?	
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
		
	class Database{
		
		private $dbname, $dbuser, $dbpwd, $dbhost, $dbport, $DB;

		public function __construct($install){
			$tmp = $install->getDBInfo();

			$this->dbname = $tmp['dbname'];
			$this->dbuser = $tmp['dbuser'];
			$this->dbpwd  = $tmp['dbpwd'];
			$this->dbhost = $tmp['dbhost'];
			$this->dbport = $tmp['dbport'];
		}

		public function connect(){
			$this->DB = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpwd,$this->dbname,$this->dbport);	
			if (mysqli_connect_errno()){
					$Error = "Errore di Connessione al DataBase: ". mysqli_connect_error();
					$this->toConsole($Error);
					return false;
			}else{
				return true;
			}
			$this->Console("Connected... ".mysqli_get_host_info($link));				
		}

		public function disconnect(){
			$this->DB->close();	
		}

		public function sanitize($String){
			return mysqli_real_escape_string($this->DB,htmlentities($String));
		}
		
		public function startQuery($Query){
			$Result = mysqli_query($this->DB, $Query) or die(json_encode(array("Status"=>"KO","REASON"=>$Query." || ".mysqli_error($this->DB),"Err.no"=>mysqli_errno($this->DB))));

			if($Result)
				return $Result;
			else
				return false;	
		}
		
		public function queryNumFields($Result){
			return mysqli_field_count($this->DB);
		}

		public function returnFirstRow($Result){
			return $Result->fetch_array(MYSQLI_BOTH);	
		}

		public function returnAllRows($Result){
			$arr = array();
			while($r = $Result->fetch_array(MYSQLI_BOTH)){
				array_push($arr, $r);
			}
			return $arr;
		}

		public function returnDataAndFields($Result){
			return $Result->fetch_fields();
		}

		// TO FIX !			
		public function toConsole($String){
			echo "<script> console.log('".$String."'); </script>";				
		}
		
		// NEEDS TESTING !
		public function queryNumRows($RQuery,$Num){
			$Result = mysqli_num_rows($RQuery);
			
			if($Result > $Num)
				return true;
			else
				return false;
		}

		// NEEDS TESTING !
		public function returnlastID(){
			return mysqli_insert_id($this->DB);
		}

	}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>