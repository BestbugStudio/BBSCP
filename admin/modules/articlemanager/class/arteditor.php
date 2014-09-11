<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/


	$title = $data['title'];
	$content=$data['content'];
	$categoryID=$data['category'];
	$pubdate = $data['pubdate'];
	$ftimage = $data['featured_image'];
	$link = $data['featured_link'];

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
?>

<br>
<head>
	<script src="./../framework/ckeditor/ckeditor.js"></script>
	<script src="./../framework/ckeditor/adapters/jquery.js"></script>
</head>

<div class=row>
	<div class="col-md-1"></div>
	<form role="form" id="installationform" action=<? echo BASEHREF.'update/';?>artreceiver.php method="post">
	<input type="text" name="article_id" style="display:none" value=<? echo '"'.$article_id.'"';?>></input>

		<div class="col-md-6" id="columneditor">
			<div class="input-group articleTitle">
				<span class="input-group-addon">Article Title</span>
				<input type="text" class="form-control" id="articleTitle" name="article_title" value=<? echo '"'.$title.'"'; ?>></input>
			</div>

			<textarea name="article_content" id="editor"><? echo $content; ?></textarea><br>
			<button type="submit" class="btn btn-default savebutton savearticle" style="background-color:#C67171;color:black"><strong>Save</strong></button>
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
</div>

<script>
	CKEDITOR.replace("editor", {customConfig: "./customckconfig.js"});
	$(<?php echo '"#check_'.$categoryID.'"';?>).prop("checked",true);
	$("#datetimepicker").datetimepicker({format:"Y-m-d H:i:s"});
</script>

<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>

