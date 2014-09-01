<?php

	/**
	* 
	*/
	class divelement implements idivelement{
		
		private $fatherId; //Dentro quale div si trova
		private $childId; //Che div contiene
		private $myId; //Id di questo div
		private $divInfo; //dimensioni del div (sfruttando le classi di bootstrap) e le classi custom a cui appartiene
		private $divContent; //il contenuto del div (es. img,chiamata a classi di php etc)
		private $divCss;
		

		function __construct($strings){
			$this->fatherId = $strings[0];
			$this->childId = $strings[1];
			$this->myId = $strings[2];
			$this->divInfo = $strings[3];
			$this->divContent = $strings[4];
			$this->divCss = $strings[5];
		}
		//FUNZIONI WIP
		public function getHtml(){ /*Ritorna un html simile a <div class="xs-col-12 customCsss" id="divID"> Testo di<a href="">esempio</a> <?php echo "funzione php";?> SENZA il </div>*/ 
			return $this->divInfo.$this->divContent;
		}
		//Anziche ricreare tutto aggiorno solamente i dati [se devo cancellare un div e aggiungerne uno nuovo tanto vale aggiornare quello in disuso]
		public function setDiv($strings){
			$this->fatherId = $strings[0];
			$this->childId = $strings[1];
			$this->myId = $strings[2];
			$this->divInfo = $strings[3];
			$this->divContent = $strings[4];
			$this->divCss = $strings[5];
		}
		public function getDiv(){
			return array($this->fatherId,$this->childId,$this->myId,$this->divInfo,$this->divContent,$this->divCss);
		}
		public function getParent(){
			return $this->fatherId;
		}
		public function setParent($parent){
			$this->fatherId = $parent;
		}
		public function getId(){
			return $this->myId;
		}
		public function setId($id){
			$this->myId = $id;
		}
		public function getChild(){
			return $this->childId;
		}
		public function setChild($child){
			$this->childId = $child;
		}
		public function getCss(){
			return $this->divCss;
		}
		public function setCss($css){
			$this->divCss = $css;
		}
		public function getContent(){
			return $this->divContent;
		}
		public function setContent($content){
			$this->divContent->$content;
		}
	}


?>