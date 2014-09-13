<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

	if(isset($_POST['update'])){
		include dirname(__FILE__).'/../../../../models/Category.php';

		$DB = new Database(Install::getInstance());
		$DB->connect();

		$id = $_POST['idCategory'];
		$name = $_POST['category_name'];

		$Category = new Category($id, $name);

		if($id == -1){
			$response = $Category->addNewData();
		}else{
			$response = $Category->updateData();
		}
		
		$resposearr = json_decode($response,true);

		if($resposearr['Status'] == "OK"){
			// TODO: SET NEW $GET VALUE TO THE NEW ID
			$_GET['edit'] = "cat_".$id;
			echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$resposearr['Message'].'</div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$resposearr['Message'].'</div>';
		}

	}else{
		$id = split("_",$_GET['edit'])[1];
		$name = $data['category_name'];
	}

?>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-4"><h4>Update category</h4></div>
	<div class="col-md-7 alert"></div>
</div>
<form method="POST" action="#">
	<input type="text" name="idCategory" style="display:none" value=<? echo '"'.$id.'"';?>></input>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-3" id="columneditor">		
			<div class="input-group categoryNameBox">
				<span class="input-group-addon">Category Name</span>
				<input type="text" class="form-control" name="category_name" id="category_name" value=<?echo '"'.$name.'"' ?>></input>
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