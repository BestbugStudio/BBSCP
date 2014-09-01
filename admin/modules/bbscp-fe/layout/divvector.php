<?php
	/**
	*  divVector è la classe che implementa la struttura dati che conterrà i div
	*/
	class divvector implements idivvector{
		
		private $listDivElements = array();
		private $counter;
		private $actualPos;

		function __construct(){
			# code...
			$this->listDivElements = array();
			$this->counter = 0;
			$this->actualPos = 0;
		}

		public function hasMoreElement(){
			if(!($this->actualPos > $this->counter))
				return true;
			else
				return false;
		}

		public function orderElement(){ //Funzione da eliminare 13.13 pausa
		//shif a dx di tutti gli elementi, mi semplificherà la creazione della pagina in builder [nb magari si potrà poi eliminare in futuro]
			$arraySup = array();
			$totalEle = $this->counter;
			$numberEle = 0;
			while($this->hasMoreElement()){
				$thisPos = $totalEle-$numberEle;
				$arraySup[$thisPos] = $this->getNextElement();
				$numberEle++;
				echo "giro";
				echo $thisPos;
			}
			//print_r($this->listDivElements);
		}

		public function getElementAt($pos){
			try{
				$element = $this->listDivElements[$pos];
				return $element;
			}catch (Exception $e) {
			    echo $e->getMessage(), "\n";
			}
		}

		public function insertElement($element){ 
			$this->listDivElements[$this->counter] = $element;
			$this->counter++;
		}


		public function getNextElement(){
			if($this->hasMoreElement()){
				$divElement = $this->listDivElements[$this->actualPos];
				$this->actualPos++;
				return $divElement;
			}
			else
				return null;
		}

		public function setIndexSearchTo($pos){
			$this->actualPos = $pos;
			return 1;
		}

		public function getAllElements(){
			return $this->listDivElements;
		}
	}
?>