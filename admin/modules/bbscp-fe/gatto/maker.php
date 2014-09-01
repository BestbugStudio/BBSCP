<?php
	/**
	* Classe che si occupa di recuperare le varie parti dinamiche e statiche della pagina, nb si sta sfruttando il pattern singleton
	*/
	class maker implements imaker{
			
		private static $objMaker =  null;
		private $CLASS_PATH = "./class/";

		function __construct(){
			
		}

		static function getMaker(){
			if (self::$objMaker == null){
				self::$objMaker = new maker();
				return self::$objMaker;
			}else{
				return self::$objMaker;
			}
		}

		function getbody($idPage){
			$html = $this->getPage($idPage);
			return $html;
		}


		public function getPage($idPage){

			ob_start();
			include $this->CLASS_PATH.$idPage;
			$page = ob_get_clean();

			return $page;
		}
	}
?>