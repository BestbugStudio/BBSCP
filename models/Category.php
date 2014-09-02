<?

Class Category{

	private $id;
	private $categoryname;

	public function __construct($id, $categoryname){

		$this->id = $id;
		$this->categoryname = $categoryname;
	}

	public function getId(){
		return $this->id;
	}
	public function getCategoryName(){
		return $this->categoryname;
	}

	public function addNewCategory($Category){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->addNewCategory($Category->categoryname));
	}

	public function updateCategory($Category){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->updateCategory($Category->id,$Category->categoryname));
	}

	public function deleteCategory($Category){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->deleteCategory($Category->id));
	}

}

?>