<?

	include dirname(__FILE__).'/../../../../models/Article.php';

echo 'POST:<br>';
	print_r($_POST);
echo '<br>FILE:<br>';
	var_dump($_FILE);
echo '<br>';

	$DB = new Database(Install::getInstance());
	$DB->connect();
	
	// GET POST DATA, CREATE ARTICLE OBJECT AND UPDATE IT IN DATABASE
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

	echo $response;

?>