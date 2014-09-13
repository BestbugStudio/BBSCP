<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

include_once dirname(__FILE__).'/modelinterface.php';
include_once dirname(__FILE__).'/responseFunction.php';

Class Category implements modelinterface{

	private $id, $categoryname;

	public function __construct($id, $categoryname){

		$this->id = $id;
		$this->categoryname = $categoryname;
	}

	public function getObjectData(){
		return json_encode(array(
				'idCategory'	=> $this->id,
				'category_name'	=> $this->categoryname
			));
	}
	
	public function getId(){
		return $this->id;
	}

	public function getFromId($id){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->getCategoryFromId($id));
		$res = $DB->returnFirstRow($res);

		$DB->disconnect();
		return sendResponse('Category found','Error, category not found',$res,false);
	}

	public static function getAllData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->getAllCategories());
		$res = $DB->returnAllRows($res);

		$DB->disconnect();
		return sendResponse('All categories found','Error, no category has been found',$res,false);
	}

	public function addNewData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->addNewCategory($this->getObjectData()));
		
		$DB->disconnect();
		return sendResponse('Category successfully added','Something went wrong while adding the category, try again',$res,true);
	}

	public function updateData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->updateCategory($this->getObjectData()));

		$DB->disconnect();
		return sendResponse('Category successfully updated','Something went wrong, check the information you entered',$res,true);
	}

	public function deleteData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->Connect();

		$res = $DB->StartQuery($Q->deleteCategory($this->getId()));

		$DB->disconnect();
		return sendResponse('Category successfully deleted','Something went wrong, try again',null,true);
	}
}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>