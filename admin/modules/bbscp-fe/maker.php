<?php
	/**
	* Classe che si occupa di recuperare le varie parti dinamiche e statiche della pagina, nb si sta sfruttando il pattern singleton
	*/
	class maker implements imaker{
			
		private static $objMaker =  null;
		private $CLASS_PATH = "./class/"

		function __construct(){
			$this->$divVector = builder::getBuilder();
		}

		static function getMaker(){
			if ($objMaker == null){
				$objMaker = new maker();
				return $objMaker;
			}else{
				return $objMaker;
			}
		}

		function getbody($idPage){

			$html = $this->getPage($idPage);
			return $html;
		}


		public function getPage($idPage){
			$page = shell_exec($CLASS_PATH.$idPage);
			return $page;
		}
	}
?>