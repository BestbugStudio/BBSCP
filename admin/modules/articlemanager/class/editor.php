<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

Class Editor{

	public function showEditorFor($what,$id){

		$title = "";
		$category = 0;
		$content = "";

		$DB= new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();
	
		if($id != -1){

			switch($what){
				case ARTLBL:
				echo "asd";
					$data = $DB->returnFirstRow($DB->startQuery($Q->getArticleFromId($id)));
					break;
				case CATLBL:
				echo "lol";
					$data = $DB->returnFirstRow($DB->startQuery($Q->getCategoryFromId($id)));

				default:break;
			}

			
		}
		
		ob_start();
		include dirname(__FILE__).'/'.$what.'editor.php';
	}


}
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>