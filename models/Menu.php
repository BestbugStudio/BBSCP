<?

Class Menu{

	private $id;
	private $menu_title;
	private $menu_category;
	private $submenu_of;
	private $staticCheck;

	public function __construct($id, $menu_title, $staticCheck, $menu_category, $submenu_of){
		$this->id = $id;
		$this->menu_title = $menu_title;
		$this->staticCheck = $staticCheck;
		$this->menu_category = $menu_category;
		$this->submenu_of = $submenu_of;
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

	public function addNewMenu($Menu){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->addNewMenu($Menu->menu_title,$Menu->menu_category,$Menu->staticCheck,$Menu->submenu_of));
	}

	public function updateMenu($Menu){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->updateMenu($Menu->id,$Menu->menu_title,$Menu->menu_category,$Menu->staticCheck,$Menu->submenu_of));
	}

	public function deleteMenu($Menu){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->deleteMenu($Menu->id));
	}

}

?>