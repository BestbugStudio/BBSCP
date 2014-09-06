<?
		//Main constructor will load all the modules

		// Menu will be created fetching data from database.bbscp_admin_menu
		//		When a module is installed it will save its necessary menus in this table

		// When a menu is clicked the following code will be executed:
		//	$obj = include MODULES.'/'.$clickedMenu.'/index.php';		#MODULES will be a defined variable in a php scrit in modules folder
		//	$obj->getOption/View/any provided method

		$oggetto = include dirname(__FILE__).'/../modules/articlemanager/index.php';

		var_dump($oggetto);
		$oggetto->getView($pippo);

?>