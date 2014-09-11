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
			
		$title = $articleData['title'];
		$content=$articleData['content'];
		$categoryID=$articleData['category'];
		$pubdate = $articleData['pubdate'];
		$ftimage = $articleData['featured_image'];
		$link = $articleData['featured_link'];

		$categoriesArray = $DB->returnAllRows($DB->StartQuery($Q->getAllCategories()));

		$categoriesView = "";

		foreach($categoriesArray as $cat){
			$categoriesView .= '<div class="input-group categoryGroup">
								<span class="input-group-addon">
									<input class="categorycheck" type="checkbox" id="check_'.$cat['idCategory'].'">
								</span>
								<span class="form-control categoryName">'.$cat['category_name'].'</span>
								</div>';
		}

		echo '
			<br>
			<script src="./../framework/ckeditor/ckeditor.js"></script>
			<script src="./../framework/ckeditor/adapters/jquery.js"></script>
			
			<div class=row>
				<div class="col-md-1"></div>
				<div class="col-md-6" id="columneditor">
			
					<div id="'.$article_id.'" class="input-group articleTitle">
						<span class="input-group-addon">Article Title</span>
						<input type="text" class="form-control" id="articleTitle" value="'.$title.'"></input>
					</div>
			
					<textarea name="editor" id="editor">'.$content.'</textarea><br>
					<button class="savebutton savearticle"><a href="#">Save!</a></button>
				</div>
			
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 chooseCategory picker">
							<div class="well well-sm">Select category</div>
							<div class="col-md-12"><form>
									'.$categoriesView.'
							</form></div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 pickdate picker">
							<div class="well well-sm">Pub date</div>
							<input style="margin-left:20px;" id="datetimepicker" type="text" value="'.$pubdate.'">
						</div>
						<div class="col-md-2"></div>
					</div>

					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 pickimage picker">
							<div class="well well-sm">Featured Image</div>
							<form action="register.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /><input id="ftimage" name="image" type="file" value="immagine">
							</form>

						</div>
						<div class="col-md-2"></div>
					</div>

					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 linkpicker picker">
							<div class="well well-sm">Featured Link</div>
							<input style="margin-left:20px;" id="ftlink" name="link" type="text" value="'.$link.'">
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>	
			</div>

			<script>CKEDITOR.replace("editor", {customConfig: "./customckconfig.js"});$("#check_'.$categoryID.'").prop("checked",true);$("#datetimepicker").datetimepicker({format:"Y-m-d H:i:s"});</script>';

	}


}
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>