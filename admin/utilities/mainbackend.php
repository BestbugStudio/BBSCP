<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

include_once dirname(__FILE__).'/../../abspath.php';
include_once ABSOLUTEPATH.'/config/query.php';
include_once ABSOLUTEPATH.'/utilities/database.php';
include_once dirname(__FILE__).'/printtable.php';

Class MainBackend{

	public function __construct(){
		$this->printMenu();

		if(isset($_GET['module'])){
			$this->loadModule($_GET['module'],json_encode($_GET));
		}
	}

	private function printMenu(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$menu = $DB->startQuery($Q->getAllAdminMenu());
		$menu = $DB->returnAllRows($menu);

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
		
		for ($i=0; $i < count($menu); $i++){
			$menutitle = $menu[$i]['menu_title'];
			$trimmedtitle= str_replace(" ", "", $menutitle);
			$modulename = $menu[$i]['modulename'];
			$options = $menu[$i]['options'];

			if($menu[$i]['submenu_of'] == 0){			

				$thisID = $menu[$i]['idMenu'];
				$submen = $this->search($menu, 'submenu_of', $thisID);

				if(!empty($submen)){
					$menuStr.='
							<li id="trimmedname" class="nav menuitem dropdown">
								<a id="drop_'.$trimmedtitle.'" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">'.$menutitle.'<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="drop_'.$trimmedtitle.'">';

					foreach ($submen as $sm) {
						$href = $this->getUrlFromOptions($modulename,$sm['options']);
						$menuStr .= $this->getMenuListItem($sm['menu_title'],str_replace(" ", "", $sm['menu_title']),$href);
					}
					$menuStr .= '</ul></li>';

				}else{
					$href = $this->getUrlFromOptions($modulename,$menu[$i]['options']);
					$menuStr.=$this->getMenuListItem($menutitle,$trimmedtitle,$href);
				}
			}
		}

		$menuStr .= '		<li id="Logout" class="nav menuitem logout"><a href="?logout=true">Logout</a></li>
						</ul>
					</div>
				</div>
			</nav>';
		
		echo $menuStr;
	}

	private function loadModule($clicked,$opt){
		$oggetto = include dirname(__FILE__).'/../modules/'.$clicked.'/index.php';
		$oggetto->getView($opt);
	}
	private function getMenuListItem($menutitle,$trimmedtitle,$href){
		return '<li id="'.$trimmedtitle.'" class="nav menuitem"><a class="menuitem" href="'.$href.'">'.$menutitle.'</a></li>';
	}
	private function getUrlFromOptions($modulename,$opt){
		$optquery = "";
		if(!empty($opt)){
			$optquery = '&'.http_build_query(json_decode($opt,true));
		}
		return $href = "?module=".$modulename.$optquery;
	}
	private function search($array, $key, $value){
	    $results = array();
	    if (is_array($array)) {
	        if (isset($array[$key]) && $array[$key] == $value) {
	            $results[] = $array;
	        }
	        foreach ($array as $subarray) {
	            $results = array_merge($results, $this->search($subarray, $key, $value));
	        }
	    }
	    return $results;
	}
}	
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>