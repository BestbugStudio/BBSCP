<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

Class ArticleManager{

	public function getOptions(){

	}
	
	public function getView($options){

		if(isset($_GET['edit'])){
			$this->showEditor($_GET['edit']);
			die;
		}elseif(isset($_GET['rem'])){
			$this->removeData($_GET['rem']);
			die;
		}

		$optarr = http_build_query(json_decode($options,true));
		$selected = json_decode($options,true)['list'];
		$tabletitle = "";

		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		switch ($selected) {
			case 'article':
				$res = $DB->StartQuery($Q->getAllarticlesInfo());
				$listArray = $DB->ReturnAllRows($res);
				$numbFields= $DB->queryNumFields($res);
				$tabletitle = "Manage Articles";
				break;
			
			case 'category':
				$res = $DB->StartQuery($Q->getAllCategories());
				$listArray = $DB->ReturnAllRows($res);
				$numbFields= $DB->queryNumFields($res);
				$tabletitle = "Manage Categories";	
				break;
			
			case 'tag':
				$res = $DB->StartQuery($Q->getAllTags());
				$listArray = $DB->ReturnAllRows($res);
				$numbFields= $DB->queryNumFields($res);
				$tabletitle = "Manage Tags";	
				break;
			
			default: break;
		}

		$PrintTable = new PrintTable($tabletitle, $listArray, $numbFields, $optarr, '&edit=idart_', '&rem=idart_');
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