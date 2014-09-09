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

		//echo $options;

		$selected = json_decode($options,true)['show'];

		switch ($selected) {
			case 'articleList':

				$DB = new Database(Install::getInstance());
				$Q = new Query();
				$DB->Connect();

				$listArray = $DB->ReturnAllRows($DB->StartQuery($Q->getAllarticlesInfo()));
				$numbFields= $DB->queryNumFields($DB->StartQuery($Q->getAllArticlesInfo()));

				$PrintTable = new PrintTable("Manage Articles",$listArray, $numbFields);

				break;
			
			case 'categoryList':
				echo 'Category VIEW!';
				break;
			
			case 'tagList':
				echo 'TAG VIEW!';
				break;
			
			default:
				
				break;
		}
	}
}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>