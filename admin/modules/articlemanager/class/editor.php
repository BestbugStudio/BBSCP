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
			
		$articleData = $DB->returnFirstRow($DB->startQuery($Q->getArticleFromId($id)));
		
		$_POST['articledata'] = $articleData;

		ob_start();
		include dirname(__FILE__).'/'.$what.'editor.php';
	}


}
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>