public function getPage($getelement){

	ob_start();
	include "/pages/".$getelement;
	return ob_get_clean();
}

public function getModule(custommodule){
	ob_start();
	include "/modules/".custommodule."/index.php?";
	return ob_get_clean();
}