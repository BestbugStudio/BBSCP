<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

require dirname(__FILE__).'/modelinterface.php';
include_once dirname(__FILE__).'/responseFunction.php';

Class Article implements modelinterface{

	private $id, $title, $category, $content, $pubdate, $ftimage, $link;

	public function __construct($id, $title, $category, $content, $pubdate, $ftimage, $link){

		$this->id = $id;
		$this->title = $title;
		$this->category = $category;
		$this->content = $content;
		$this->pubdate = $pubdate;
		$this->ftimage = $ftimage;
		$this->link = $link;
	}

	public function getObjectData(){
		return json_encode(array(
				'id'		=> $this->id,
				'title'		=> $this->title,
				'category'	=> $this->category,
				'content'	=> $this->content,
				'pubdate'	=> $this->pubdate,
				'ftimg'		=> $this->ftimage,
				'link'	 	=> $this->link
			));
	}

	public function getId(){
		return $this->id;
	}

	public function getFromId($id){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->getArticleFromId($id));
		$res = $DB->returnFirstRow($res);

		$DB->disconnect();
		sendResponse('Article found','No article found',$res,false);
	}

	public function getFromCategory($category){
		$DB = new Database(Install::getInstance());
		$Q = new Query;
		$DB-> connect();

		$res = $DB->startQuery($Q->getArticlesFromCategory($category));
		$res = $DB->returnAllRows($res);

		$DB->disconnect();
		sendResponse('Articles found','No articles found for this category',$res,false);
	}


	public static function getAllData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query;
		$DB-> connect();

		$res = $DB->startQuery($Q->getAllArticles());
		$res = $DB->returnAllRows($res);

		$DB->disconnect();
		sendResponse('Articles found','No articles found',$res,false);
	}

	public function addNewData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->addNewArticle($this->getObjectData()));

		$DB->disconnect();
		sendResponse('Article successfully added','Something went wrong with the query',null,true);
	}

	public function updateData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->updateArticle($this->getObjectData()));
		
		$DB->disconnect();
		sendResponse('Article successfully update','Something went wrong, check the information you provided',null,true);
	}

	public function deleteData(){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->deleteArticle($this->getId()));

		$DB->disconnect();
		sendResponse('Article deleted successfully','Something went wrong while deleting the article',null,true);
	}
}

?>