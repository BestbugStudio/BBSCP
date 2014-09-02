<?

Class Article{

	private $id;
	private $title;
	private $category;
	private $content;
	private $pubdate;
	private $ftimage;
	private $link;

	public function __construct($id, $title, $category, $content, $pubdate, $ftimage, $link){

		$this->id = $id;
		$this->title = $title;
		$this->category = $category[0];
		$this->content = $content;
		$this->pubdate = $pubdate;
		$this->ftimage = $ftimage;
		$this->link = $link;
	}

	public function getId(){
		return $this->id;
	}
	public function getTitle(){
		return $this->title;
	}
	public function getCategory(){
		return $this->category;
	}
	public function getContent(){
		return $this->content;
	}
	public function getPubDate(){
		return $this->pubdate;
	}
	public function getFeaturedImage(){
		return $this->ftimage;
	}
	public function getLink(){
		return $this->link;
	}

	public function addNewArticle($Article){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->addNewArticle($Article->title,$Article->content,$Article->category,$Article->pubdate,$Article->ftimage,$link->link));
	}

	public function updateArticle($Article){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->updateArticle($Article->id,$Article->title,$Article->content,$Article->category,$Article->pubdate,$Article->ftimage,$Article->link));
	}

	public function deleteArticle($Article){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->deleteArticle($Article->id));
	}

}

?>