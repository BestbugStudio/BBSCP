<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

Class ArticleManager{

	private $modulename = "articlemanager";
	private $childmenu = array();

	public function getOptions(){

	}
	
	public function getView($options){

		//echo $options;

		if(isset($_GET['edit'])){
			$this->showEditor($_GET['edit']);
			die;
		}elseif(isset($_GET['rem'])){
			$this->removeData($_GET['rem']);
			die;
		}


		$optarr = http_build_query(json_decode($options,true));
		$selected = json_decode($options,true)['show'];

		switch ($selected) {
			case 'articleList':

				$DB = new Database(Install::getInstance());
				$Q = new Query();
				$DB->Connect();

				$res = $DB->StartQuery($Q->getAllarticlesInfo());
				$listArray = $DB->ReturnAllRows($res);
				$numbFields= $DB->queryNumFields($res);

				$PrintTable = new PrintTable("Manage Articles",$listArray, $numbFields, $optarr, '&edit=idart_', '&rem=idart_');

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

	private function showEditor($id_num){
		echo "Here's the editor ".$id_num;
	}
	private function removeData($id_num){
		echo "I'll delete ".$id_num;
	}
}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>