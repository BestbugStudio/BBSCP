<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	include dirname(__FILE__).'/editor.php';

	define(ARTLBL, 'art');
	define(CATLBL, 'cat');
	define(TAGLBL, 'tag');

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
		$what = "";

		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		switch ($selected) {
			case 'article':
				$res = $DB->startQuery($Q->getAllarticlesInfo());
				$listArray = $DB->returnAllRows($res);
				$numbFields= $DB->queryNumFields($res);
				$tabletitle = "Manage Articles";
				$what = ARTLBL;
				break;
			
			case 'category':
				$res = $DB->startQuery($Q->getAllCategories());
				$listArray = $DB->returnAllRows($res);
				$numbFields= $DB->queryNumFields($res);
				$tabletitle = "Manage Categories";
				$what = CATLBL;
				break;
			
			case 'tag':
				$res = $DB->startQuery($Q->getAllTags());
				$listArray = $DB->returnAllRows($res);
				$numbFields= $DB->queryNumFields($res);
				$tabletitle = "Manage Tags";
				$what = TAGLBL;
				break;
			
			default: break;
		}

		$listArray = array_reverse($listArray);

		$PrintTable = new PrintTable($tabletitle, $listArray, $numbFields, $optarr, '&edit='.$what.'_', '&rem='.$what.'_');
	}

	private function showEditor($what_id){
		echo "Here's the editor ".$what_id;

		$what = split("_", $what_id)[0];
		$id_n = split("_", $what_id)[1];

		$Editor = new Editor();
		$Editor-> showEditorFor($what,$id_n);
	}
	
	private function removeData($id_num){
		echo "I'll delete ".$id_num;
	}
}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>