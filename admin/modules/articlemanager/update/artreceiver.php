<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
	
	include dirname(__FILE__).'/../../../../models/Article.php';

	$DB = new Database(Install::getInstance());
	$DB->connect();
	
	$id 	= $DB->sanitize($_POST['article_id']);
	$title	= $DB->sanitize($_POST['article_title']);
	$catId	= $DB->sanitize(split("_",$_POST['article_category'])[2]);
	$content= $DB->sanitize($_POST['article_content']);
	$pubdate= $DB->sanitize($_POST['article_pubdate']);
	$link	= $DB->sanitize($_POST['article_link']);
	$ftimage= $DB->sanitize($_POST['article_image']);

	$Article = new Article($id, $title, $catId, $content, $pubdate, $ftimage, $link);

	if($id == -1){
		$response = $Article->addNewData();
	}else{
		$response = $Article->updateData();
	}

	$jres = json_decode($response,true);
	$stat = $jres['Status'];

	if($stat == "OK"){
		//Get back to previous page with OK status
	}else{
		//Get back to previous page with KO status
	}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>