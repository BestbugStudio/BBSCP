<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

include_once dirname(__FILE__).'/modelinterface.php';
include_once dirname(__FILE__).'/responseFunction.php';

Class Menu implements modelinterface{

	private $id, $menu_title, $menu_category, $submenu_of, $staticCheck;

	public function __construct($id, $menu_title, $staticCheck, $menu_category, $submenu_of){
		$this->id = $id;
		$this->menu_title = $menu_title;
		$this->staticCheck = $staticCheck;
		$this->menu_category = $menu_category;
		$this->submenu_of = $submenu_of;
	}

	public function getObjectData(){
		return json_encode(array(
			'id'			=> $this->id,
			'menu_title'	=> $this->menu_title,
			'static'		=> $this->staticCheck,
			'category'		=> $this->menu_category,
			'submenu_of'	=> $this->submenu_of
		));
	}

	public function getId(){
		return $this->id;
	}
	public function getMenuTitle(){
		return $this->menu_title;
	}
	public function getMenuCategory(){
		return $this->menu_category;
	}
	public function getMenuStaticCheck(){
		return $this->staticCheck;
	}
	public function getParentMenu(){
		return $this->submenu_of;
	}
		
	public function getFromId($id){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->getSiteMenuFromId($id));
		$res = $DB->returnFirstRow($res);

		$DB->disconnect();
		sendResponse('Here\'s the menu you asked for','No menu found',$res,false);
	}

	public function getAdminMenuFromId($id){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->getAdminMenuFromId($id));
		$res = $DB->returnFirstRow($res);

		$DB->disconnect();
		sendResponse('Here\'s the menu you asked for','No menu found',$res,false);
	}

	public static function getAllData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query;
		$DB-> connect();

		$res = $DB->startQuery($Q->getAllSiteMenu());
		$res = $DB->returnAllRows($res);

		$DB->disconnect();
		sendResponse('Menus found','No menus found',$res,false);
	}

	public function getAllAdminMenuData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query;
		$DB-> connect();

		$res = $DB->startQuery($Q->getAllAdminMenu());
		$res = $DB->returnAllRows($res);

		$DB->disconnect();
		sendResponse('Menu found','No menu found',$res,false);
	}

	public function addNewData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->addNewSiteMenu($this->getObjectData()));
		
		$DB->disconnect();
		sendResponse('Menu successfully added','Something went wrong while adding the menu, try again',null,true);
	}

	public function updateData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->updateSiteMenu($this->getObjectData()));

		$DB->disconnect();
		sendResponse('Menu successfully updated','Something went wrong, check the information you entered',null,true);
	}

	public function deleteData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->deleteSiteMenu($this->getId()));

		$DB->disconnect();
		sendResponse('Menu successfully deleted','Something went wrong, try again',null,true);
	}

}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>