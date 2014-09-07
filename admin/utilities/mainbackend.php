<?
		//Main constructor will load all the modules

		// Menu will be created fetching data from database.bbscp_admin_menu
		//		When a module is installed it will save its necessary menus in this table

		// When a menu is clicked the following code will be executed:
		//	$obj = include MODULES.'/'.$clickedMenu.'/index.php';		#MODULES will be a defined variable in a php scrit in modules folder
		//	$obj->getOption/View/any provided method

include_once dirname(__FILE__).'/../../abspath.php';
include_once ABSOLUTEPATH.'/config/query.php';
include_once ABSOLUTEPATH.'/utilities/database.php';

Class MainBackend{

		public function __construct(){
			$this->printMenu();

			if(isset($_GET['module'])){
				$this->loadModule($_GET['module']);
			}
		}

		private function printMenu(){
			$DB = new Database(Install::getInstance());
			$Q = new Query();
			$DB->connect();

			$menu = $DB->startQuery($Q->getAllAdminMenu());
			$menu = $DB->returnAllRows($menu);
			print_r($menu);


			$menuStr = '
				<nav class="navbar navbar-default CPmenu" role="navigation">
					<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li id="home" class="nav menuitem"><a href="index.php"><span class="glyphicon glyphicon-home homespan"></span></a></li>';

			echo "<br>";
			// foreach ($menurow as $m) {
			for ($i=0; $i < count($menu); $i++){

				$menutitle = $menu[$i]['menu_title'];
				$trimmedtitle= str_replace(" ", "", $menutitle);

				if($menu[$i]['submenu_of'] == 0){
					// PARENT ITEM

					// IF (next item is child){ Construct dropdown }
					// ELSE { Construct simple item }
					$menuStr.=$this->getMenuListItem($menutitle,$trimmedtitle,"#");

				}else{
					// CHILD ITEM
				}
				
				print_r($m);
				echo "</br>";
			}

			$menuStr .= '		<li id="Logout" class="nav menuitem logout"><a href="?f=logout.php">Logout</a></li>
							</ul>
						</div>
					</div>
				</nav>';
			
			echo $menuStr;



			// STATIC MENU
			$menuStr = '
			<nav class="navbar navbar-default CPmenu" role="navigation">
				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li id="home" class="nav menuitem"><a href="index.php"><span class="glyphicon glyphicon-home homespan"></span></a></li>
							
							<li id="menus" class="nav menuitem">
								<a href="?module=menumanager">Manage Menu</a>
							</li>

							<li id="trimmedname" class="nav menuitem dropdown">
								<a id="drop_trimmedname" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Article Manager <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
									<li id="trimmedname"><a class="menuitem" href="?module=articlemanager">Edit Articles</a></li>
									<li id="trimmedname"><a class="menuitem" href="?module=articlemanager">Edit Categories</a></li>
								</ul>
							</li>

						<!--	<li id="categories" class="nav menuitem"><a href="?module=articlemanager">Manage Categories</a></li>-->
						<!--	<li id="articles" class="nav menuitem"><a href="?f=lister.php&type=articles">Manage Articles</a></li>-->
							<li id="users" class="nav menuitem"><a href="?f=lister.php&type=users">Manage Users</a></li>
							<li id="Logout" class="nav menuitem logout"><a href="?f=logout.php">Logout</a></li>
						</ul>
					</div>
				</div>
			</nav>';

			echo $menuStr;

		}

		private function loadModule($clicked){
			$oggetto = include dirname(__FILE__).'/../modules/'.$clicked.'/index.php';
			$oggetto->getView($pippo);
		}


		private function getMenuListItem($menutitle,$trimmedtitle,$href){
			return '<li id="'.$trimmedtitle.'" class="nav menuitem"><a class="menuitem" href="'.$href.'">'.$menutitle.'</a></li>';
		}


}

?>