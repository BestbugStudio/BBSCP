<?

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

require dirname(__FILE__).'/modelinterface.php';

Class User implements modelinterface{

	private $id, $nickname, $password, $firstname, $lastname, $mail, $confirmed;

	public function __construct($id, $nickname, $password, $firstname, $lastname, $mail, $confirmed){
		$this->id = $id;
		$this->nickname = $nickname;
		$this->password = $password;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->mail = $mail;
		$this->confirmed = $confirmed;
	}

	public function getData(){
		return json_encode(array(
				'id'		=> $this->id,
				'nickname'	=> $this->nickname,
				'password'	=> $this->password,
				'firstname'	=> $this->firstname,
				'lastname'	=> $this->lastname,
				'mail'		=> $this->mail,
				'confirmed' => $this->confirmed
			));
	}

	public function getId(){
		return $this->id;
	}

	public function getFromId($id){
		return 'asd';
	}

	public function addNewData($User){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->addNewUser($User->nickname,$User->password,$User->firstname,$User->lastname,$User->mail,$User->confirmed));

		$DB->disconnect();
		return $res;
	}

	public function updateData($User){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->updateMenu($Menu->id,$Menu->menu_title,$Menu->menu_category,$Menu->staticCheck,$Menu->submenu_of));
	}

	public function deleteData($User){
		$DB = new Database();
		$Q = new Query();
		$DB->Connect();

		$DB->StartQuery($Q->deleteMenu($Menu->id));
	}

}
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>