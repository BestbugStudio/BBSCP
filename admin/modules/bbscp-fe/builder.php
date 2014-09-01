<?php

	/**
	* Classe che si occupa di fare controller tra il front end [NOTA: il sito] e il back-end [NOTA: si tratta di bbscp - frontend]
	* ATTENZIONE: al momento il pattern singleton sembra non funzionare quando formmanager richiama getbuilder OPPURE non viene salavato in 
	* $objBuilder l'oggetto singleton :S, risolto sfruttando $_SESSION, successivamente ci sarà l'implementazione del salvataggio su disco
	* PROBLEMA: bisogna fare in modo che il sid venga passato tra una richiesta post e l'altra, quando si chiama il getbuilder si passerà 
	* il sid [ATTUALMENTE SEMBRA ESSERE FIXATO]
	*/


	

	class builder implements ibuilder{

		private static $objBuilder;
		private $CLASS_PATH;
		private $CSS_PATH;
		private $pageArray;
		private $divManager;
		private $workname;

		

		private function __construct($workname){
			$this->pageArray = array();
			$this->divManager = null;
			$this->CSS_PATH = $workname."/css/";
			$this->CLASS_PATH  = $workname."/class/";
			$this->workname = $workname;
			$this->saveWorkspace();
		}
		

		static function getBuilder($workname){
			
			if (!isset(self::$objBuilder)){
				self::$objBuilder = new builder($workname);
				
			}
				return self::$objBuilder;
			
		}

		public function addDiv($strings,$idPage){
			$page = $this->pageArray[$idPage];
			$page->set("divVector",$strings);
		}

		public function addPage($idPage){
			$this->pageArray[$idPage] = new page($idPage);
		}

		public function savePage($idPage){
			
			$page = $this->pageArray[$idPage];
			$divVector = $page->get("divVector");
			$divElementsVector = $divVector->getAllElements();
			$html = "";
			//for ($i=(count($divElementsVector)-1); $i >= 0; $i--) { 
			for($i=0;$i<=count($divElementsVector)-1;$i++){
				$element = $divElementsVector[$i];
				$html.= $element->getHtml();
			}
			$this->write($html,$this->CLASS_PATH.$idPage);
			$css = $page->get("cssPage");
			$pageName = explode(".", $idPage);
			$this->write($css,$this->CSS_PATH.$pageName[0].".css");
		}

		public function write($elementToWrite,$pathToWrite){
			if(!file_exists("../".$pathToWrite))
				$page = fopen("../".$pathToWrite, "a+");
			else
				$page = fopen("../".$pathToWrite, "w+"); 
			fwrite($page, $elementToWrite);
			fclose($page);
			$this->saveWorkspace(); // Funzione che si occupa di salvare il workspace [Builder e basta sostazialemente]
		}


		public function &getDiv($idDiv,$idPage){
			$page = $this->pageArray[$idPage];
			$divVector = $page->get("divVector");
			$found = false;
			$divVector->setIndexSearchTo(0);
			while($divVector->hasMoreElement() AND $found != true){
				$element = $divVector->getNextElement();
				if($idDiv == $element->getId())
					$found = true;
			}
			if($found)//nota delle 19.27 del 13 agosto 2014: qui mi do il 5 alto da solo perchè grazie a questo posso capire se il div che ho da modificare nel post è nuovo oppure esiste già [danilo]
				return $element;
			else
				return null;
		}

		public function getAllDivs($idPage){
			$page = $this->pageArray[$idPage];
			$divVector = $page->get("divVector");
			return $divVector->getAllElements();
		}

		public function setUpFormEditing(){
			$listPage = array_keys($this->pageArray);
			$formMaker = new formmaker("post","index.php?SID=".session_id());
			//WIP, prossimamente si visualizzeranno i div della pagina selezionata e basta

			$j=0;
			$listIdDivs = array();
			$idDivs = array();
			$divContents = array();
			echo count($this->pageArray);
			foreach ($this->pageArray as $page) {
				$formMaker->insertText("Div della pagina:".$listPage[$j]."<br>");
				$divVector = $page->get("divVector");
				$divElements = $divVector->getAllElements();
				$forms = "";
				$i=0;
				foreach ($divElements as $element) {
					$idDivs[$i] = $element->getId();
					$divData = $element->getDiv();
					$formMaker->makeTextAreaList("Data: ".$divData[4],$listPage[$j]."-".$element->getId()."-data");
					$formMaker->makeTextAreaList("CSS: ".$divData[5],$listPage[$j]."-".$element->getId()."-css"); // recupera il contenuto del div[NOTA: escluso il contenuto di un possibile secondo div innestato] 
					$formMaker->makeTextAreaList("Div info: ".$divData[3],$listPage[$j]."-".$element->getId()."-info");
					$formMaker->insertButtom("submit","editDiv");
					$forms .= $formMaker->getForm();
					$formMaker = new formmaker("post","index.php?SID=".session_id());

				}
				$listIdDivs = array_merge($listIdDivs,$idDivs);

				$j++;

			}

			
			$formMaker = new formmaker("post","index.php?SID=".session_id());
			$listIdDivs = array_merge($listIdDivs,array("none"));

			
			$formMaker->insertText("Aggiungi un nuovo div <br>");
			$formMaker->insertText("Pagina a cui appartiene il div:");
			$formMaker->makeOptList($listPage,"lista di pagine","pageId");
			$formMaker->insertText("<br>Id:");
			$formMaker->insertTextBox("newId");
			$formMaker->insertText("<br> Contenuto del nuovo di (NON INSERIRE ALTRI DIV)");
			$formMaker->makeTextAreaList("","newData");
			$formMaker->insertText("<br>Classi (oltre a quelle md,xs):");
			$formMaker->insertTextBox("newClass");
			$formMaker->insertText("<br> Dimensione per la classe md:");
			$formMaker->makeOptList(array('1','2','3','4','5','6','7','8','9','10','11','12'),"md-dimensione","bootstrap-md");
			$formMaker->insertText("<br> Dimensione per la classe xs:");
			$formMaker->makeOptList(array('1','2','3','4','5','6','7','8','9','10','11','12'),"xs-dimensione","bootstrap-xs");
			$formMaker->insertText("<br> figlio del div:");
			$formMaker->makeOptList($listIdDivs,"div-padre","div-father-id");
			$formMaker->insertText("<br>Ha come figlio il div:");
			$formMaker->insertButtom("text","childId");
			$formMaker->insertText("<br>proprietà Css:");
			$formMaker->insertTextBox("css");
			$formMaker->insertButtom("submit","addDiv");
			$forms.=$formMaker->getForm();
			$formMaker = new formmaker("post","index.php?SID=".session_id());
			$formMaker->insertText("<br>Salva la pagina:");
			$formMaker->makeOptList($listPage,"lista di pagine","pageId");
			$formMaker->insertButtom("submit","savePage");
			$formMaker->insertText('</br>Guarda il <a href="../'.$this->workname.'">progetto</a>');
			$forms.=$formMaker->getForm();
			return $forms;
		}

		public function handleStuff($post){
			if($this->divManager == null)
				$this->divManager = formmanager::getFormManager($this);
			$myManager = $this->divManager;
			echo $myManager->handlePostDiv($post);//NOTA: per il momento devo solo gestire il post per quando creo/modifico il div, per successive migliorie lo gestisco subito come caso specifico
		}

		public function recurse_copy($src,$dst) { 
		    $dir = opendir($src); 
		    @mkdir($dst); 
		    while(false !== ( $file = readdir($dir)) ) { 
		        if (( $file != '.' ) && ( $file != '..' )) { 
		            if ( is_dir($src . '/' . $file) ) { 
		                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
		            } 
		            else { 
		                copy($src . '/' . $file,$dst . '/' . $file); 
		            } 
		        } 
		    } 
		    closedir($dir); 
		} 

		public function saveWorkspace(){
			//WIP AL MOMENTO NON SALVA L'OGGETTO, DA CAPIRE COME SALVARLO SU FILE
			$pathToWrite = "../".$this->CLASS_PATH."website.prog";
			if(!file_exists($pathToWrite))
				$page = fopen($pathToWrite, "a+");
			else
				$page = fopen($pathToWrite, "w+"); 

			$myObjSerialize = serialize($this);
			fwrite($page, $myObjSerialize);
			fclose($page);
			return true;
		}

	}

?>