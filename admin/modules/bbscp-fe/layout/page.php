<?php

	/**
	* 
	*/
	class page implements ipage{
		
		private $divVector;

		function __construct(){
			$this->divVector = new divvector();
		}

		public function get($idElement){
			if($idElement == "cssPage"){
				$css="";

				for($i=0;$i<=count($this->divVector)-1;$i++){
					$divElement = $this->divVector->getElementAt($i);
					$css.= "#".$divElement->getId();
					$css.="{";

					$css.=$divElement->getCss();
					$css.="}";
				}
				return $css;
			}else
				return $this->divVector;
		}
		public function set($idElement,$item){
			if($idElement == "cssPage")//al momento inutile ma chissà, in futuro magari
				return null;
			else
				$this->divVector->insertElement(new divelement($item));
		}
	}

?>