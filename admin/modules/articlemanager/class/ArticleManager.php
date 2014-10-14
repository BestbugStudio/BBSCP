<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	include dirname(__FILE__).'/editor.php';

	define(ARTLBL, 'art');
	define(CATLBL, 'cat');
	define(TAGLBL, 'tag');
	define(MODULENAME, 'articlemanager');
	define(BASEHREF, 'modules/'.MODULENAME.'/');

Class ArticleManager{

	public function getOptions(){

	}
	
	public function getView($options){

		$opthttpquery = http_build_query(json_decode($options,true));

		if(isset($_GET['edit'])){
			$this->showEditor($_GET['edit']);
			die;
		}elseif(isset($_GET['rem'])){
			
			if(isset($_POST['choice'])){
				if(!($_POST['choice'] == "KO")){
					$this->removeData($_POST['choice']);
				}
				empty($_GET['rem']);
			}else{
				$this->dialogScript($_GET['rem'], $opthttpquery);
			}
		}
	
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
				$numbFields = $DB->queryNumFields($res);
				$tabletitle = "Manage Tags";
				$what = TAGLBL;
				break;
			
			default: break;
		}

		$listArray = array_reverse($listArray);


		$this->showNewButton($what, $opthttpquery);
		$PrintTable = new PrintTable($tabletitle, $listArray, $numbFields, $opthttpquery, '&edit='.$what.'_', '&rem='.$what.'_');
	}
	private function showEditor($what_id){
		$what = split("_", $what_id)[0];
		$id_n = split("_", $what_id)[1];

		$Editor = new Editor();
		$Editor->showEditorFor($what,$id_n);
	}

	private function showNewButton($what, $opthttpquery){
		echo '<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-1"><button id="new'.$what.'" class="newButton"><a href="?'.$opthttpquery.'&edit='.$what.'_-1">Add New!</a></button></div>
			  </div><br>';
	}
	
	private function removeData($id_type){
		$DB = new Database(Install::getInstance());
		$Q = new Query();

		$type = split("_",$id_type)[1];
		$id = split("_",$id_type)[2];

		switch($type){
			case 'art':
				include dirname(__FILE__).'/../../../../models/Article.php';

				$Art = new Article($id,null,null,null,null,null,null);
				$Art->deleteData();

				break;

			case 'cat':
				include dirname(__FILE__).'/../../../../models/Category.php';

				$Cat = new Category($id,null);
				$Cat->deleteData();
				break;

			case 'tag':
				include dirname(__FILE__).'/../../../../models/Tag.php';

				$Tag = new Tag($id,null);
				$Tag->deleteData();
				break;

			default:break;
		}

		empty($_POST['choice']);
	}

	private function dialogScript($id, $opthttpquery){
		
	echo '
		<div class=row>
			<div id="alertrow" class="col-md-offset-4 col-md-4" style="z-index:1000; text-align:center; background-color:#aa6600;">
				<br>
				<span><strong>This Action can\'t be undone!</strong></span>
				<hr>

				<form method="POST" action="?'.$opthttpquery.'">
				<button type="submit" name="choice" value="OK_'.$id.'">OK, delete it!</button>
				<button type="submit" name="choice" value="KO">NO, please stop!</button>
				</form>
				<br>
			</div>
		</div>';
	}

}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>