<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	if(isset($_POST['update'])){
		include dirname(__FILE__).'/../../../../models/Category.php';

		$DB = new Database(Install::getInstance());
		$DB->connect();

		$Category = new Category($id, $title);

		if($id == -1){
			$response = $Article->addNewData();
		}else{
			$response = $Article->updateData();
		}

		$stat = json_decode($response,true)['Status'];

		echo $stat;
	}

?>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-4"><h4>Update category</h4></div>
	<div class="col-md-7 alert"></div>
</div>
<form action="#">
	<input type="text" name="article_id" style="display:none" value=<? echo '"'.$data['idCategory'].'"';?>></input>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3" id="columneditor">		
			<div class="input-group categoryNameBox">
				<span class="input-group-addon">Category Name</span>
				<input type="text" class="form-control" name="category_name" id="categoryName" value=<?echo '"'.$data['category_name'].'"' ?>></input>
	  		</div>
	  	</div>
		<div class="col-md-2">
			<button class="savebutton savecategory" type="submit" name="update">Save!</button>
		</div>
		<div class="col-md-5"></div>
	</div>
</form>
<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>