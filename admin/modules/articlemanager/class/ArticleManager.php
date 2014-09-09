<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

Class ArticleManager{

	private $modulename;
	private $childmenu = array();

	public function getOptions(){

	}
	
	public function getView($options){

		echo 'ARTICLE VIEW!';
		echo $options;

		switch ($options) {
			case 'value':

				break;
			
			default:
			
				break;
		}


		// $this->dbname 	= $config->dbproperties->dbname;
		// $this->dbuser 	= $config->dbproperties->dbuser;
		// $this->dbpwd 	= $config->dbproperties->dbpwd;
		// $this->dbhost 	= $config->dbproperties->dbaddr->dbhost;
		// $this->dbport 	= (int)$config->dbproperties->dbaddr->dbdbport;


	}
}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>