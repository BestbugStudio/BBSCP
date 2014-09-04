<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

require dirname(__FILE__).'/modelinterface.php';
include_once dirname(__FILE__).'/responseFunction.php';

Class Category implements modelinterface{

	private $id, $categoryname;

	public function __construct($id, $categoryname){

		$this->id = $id;
		$this->categoryname = $categoryname;
	}

	public function getObjectData(){
		return json_encode(array(
				'id'			=> $this->id,
				'categoryname'	=> $this->categoryname
			));
	}
	
	public function getId(){
		return $this->id;
	}

	public function getFromId($id){
		$DB = new Database(Install::getInstance());
		$Q = new Query
		$DB->connect();

		$res = $DB->startQuery($Q->getCategoryFromId($id));
		$res = $DB->returnFirstRow($res);

		$DB->disconnect();
		sendResponse('Category found','Error, category not found',$res,false);
	}

	public function getAllData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query
		$DB->connect();

		$res = $DB->startQuery($Q->getAllCategories());
		$res = $DB->returnAllRows($res);

		$DB->disconnect();
		sendResponse('All categories found','Error, no category has been found',$res,false);
	}

	public function addNewData($Category){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->addNewCategory($Category->categoryname));
		
		$DB->disconnect();
		sendResponse('Category successfully added','Something went wrong while adding the category, try again',null,true);
	}

	public function updateData($Category){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->updateCategory($Category->id,$Category->categoryname));

		$DB->disconnect();
		sendResponse('Category successfully updated','Something went wrong, check the information you entered',null,true);
	}

	public function deleteData($OBJINSTANCE){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->deleteCategory($Category->id));

		$DB->disconnect();
		sendResponse('Category successfully deleted','Something went wrong, try again',null,true);
	}
}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>