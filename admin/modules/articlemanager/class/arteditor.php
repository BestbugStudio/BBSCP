<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	if(isset($_POST['update'])){
		include dirname(__FILE__).'/../../../../models/Article.php';

		$DB = new Database(Install::getInstance());
		$DB->connect();

		$article_id = $DB->sanitize($_POST['article_id']);
		$title	= $DB->sanitize($_POST['article_title']);
		$catId	= $DB->sanitize(split("_",$_POST['article_category'])[2]);
		$content= $DB->sanitize($_POST['article_content']);
		$pubdate= $DB->sanitize($_POST['article_pubdate']);
		$link	= $DB->sanitize($_POST['article_link']);
		$ftimage= $DB->sanitize($_POST['article_image']);

		$categoriesArray = $DB->returnAllRows($DB->StartQuery($Q->getAllCategories()));

		$categoriesView = "";

		foreach($categoriesArray as $cat){
			$categoriesView .= '<div class="input-group categoryGroup">
								<span class="input-group-addon">
									<input class="categorycheck" type="checkbox" id="check_'.$cat['idCategory'].'" name="article_category" value="id_category_'.$cat['idCategory'].'">
								</span>
								<span class="form-control categoryName">'.$cat['category_name'].'</span>
								</div>';
		}

		$Article = new Article($id, $title, $catId, $content, $pubdate, $ftimage, $link);

		if($id == -1){
			$response = $Article->addNewData();
		}else{
			$response = $Article->updateData();
		}

		$resposearr = json_decode($response,true);

		if($resposearr['Status'] == "OK"){
			//	 TODO: SET NEW $GET VALUE TO THE NEW ID
			// try using: header(string)
			$_GET['edit']= "art_".$article_id;

			echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$resposearr['Message'].'</div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$resposearr['Message'].'</div>';
		}
	}else{

		$title 		= $data['title'];
		$content 	= $data['content'];
		$categoryID	= $data['category'];
		$pubdate 	= $data['pubdate'];
		$ftimage 	= $data['featured_image'];
		$link 		= $data['featured_link'];

		$article_id = split("_",$_GET['edit'])[1];

		$categoriesArray = $DB->returnAllRows($DB->StartQuery($Q->getAllCategories()));

		$categoriesView = "";

		foreach($categoriesArray as $cat){
			$categoriesView .= '<div class="input-group categoryGroup">
								<span class="input-group-addon">
									<input class="categorycheck" type="checkbox" id="check_'.$cat['idCategory'].'" name="article_category" value="id_category_'.$cat['idCategory'].'">
								</span>
								<span class="form-control categoryName">'.$cat['category_name'].'</span>
								</div>';
		}

	}


?>

<br>
<head>
	<script src="./../framework/ckeditor/ckeditor.js"></script>
	<script src="./../framework/ckeditor/adapters/jquery.js"></script>
</head>

<div class=row>
	<div class="col-md-1"></div>
	<form role="form" id="installationform" action="#" method="post">
	<input type="text" name="article_id" style="display:none" value=<? echo '"'.$article_id.'"';?>></input>

		<div class="col-md-6" id="columneditor">
			<div class="input-group articleTitle">
				<span class="input-group-addon">Article Title</span>
				<input type="text" class="form-control" id="articleTitle" name="article_title" value=<? echo '"'.$title.'"'; ?>></input>
			</div>

			<textarea name="article_content" id="editor"><? echo $content; ?></textarea><br>
			<button type="submit" name="update" class="btn btn-default savebutton savearticle" style="background-color:#C67171;color:black"><strong>Save</strong></button>
		</div>

		<div class="col-md-4">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 chooseCategory picker">
					<div class="well well-sm">Select category</div>
					<div class="col-md-12"><form>
							<? echo $categoriesView; ?>
					</form>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 pickdate picker">
					<div class="well well-sm">Pub date</div>
					<input style="margin-left:20px;" id="datetimepicker" type="text" name="article_pubdate" value=<?echo '"'.$pubdate.'"';?>>
				</div>
				<div class="col-md-2"></div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 pickimage picker">
					<div class="well well-sm">Featured Image</div>
					<form action="register.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /><input id="ftimage" name="article_image" type="file" value="immagine">
					</form>

				</div>
				<div class="col-md-2"></div>
			</div>

			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 linkpicker picker">
					<div class="well well-sm">Featured Link</div>
					<input style="margin-left:20px;" id="ftlink" name="article_link" type="text" value=<?echo '"'.$link.'"';?>>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</form>
	<script>
		CKEDITOR.replace("editor", {customConfig: "./customckconfig.js"});
		$(<?php echo '"#check_'.$categoryID.'"';?>).prop("checked",true);
		$("#datetimepicker").datetimepicker({format:"Y-m-d H:i:s"});
	</script>

</div>

<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>

