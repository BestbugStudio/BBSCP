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

	public function getObjectData(){
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
		return 'TODO';
	}

	public function addNewData($User){
		$DB = new Database(Install::getInstance());
		$Q = new Query();
		$DB->connect();

		$res = $DB->startQuery($Q->addNewUser($User->nickname,$User->password,$User->firstname,$User->lastname,$User->mail,$User->confirmed));

		$DB->disconnect();

		if($res == 1){
			$response = array(
				'Status'=>'OK',
				'Message'=>'User successfully added'
			);
			return json_encode($response);
		}

		$response = array(
			'Status'=>'KO',
			'Reason'=>'Something went wrong with the query'
		);
		return json_encode($response);
	}

	public function updateData($User){
		return 'TODO';
	}

	public function deleteData($User){
		return 'TODO';
	}

}
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>