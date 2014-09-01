<?php

	/**
	* 
	*/
	class formmanager implements iformmanager{
		
		private static $objFormManager = null;
		private $builder;

		function __construct($builder){
			$this->builder = $builder;
		}

		public static function getFormManager($builder){
			if (formmanager::$objFormManager == null){
				formmanager::$objFormManager = new formmanager($builder);
			}
				return formmanager::$objFormManager;
		}



		/* 	WIP
			Momento critico: io non so come si chiamano i campi ma so che sono nello stesso ordine 
			in cui sono stampati nella funzione setUpFormEditing, quello che faccio quindi è andare 
			a gestire con un foreach i dati al loro interno sfruttando la loro posizione*/
		public function handlePostDiv($posts){ 
			if(isset($posts['addDiv']))
				return $this->handleAddDiv($posts);
			else
				return $this->handleEditDiv($posts);	
		}

		public function handleAddDiv($posts){
			$myBuilder = $this->builder;
			$preparedString = array();
			$i=0;
			foreach ($posts as $post) {
				$preparedString[$i] = $post;
				$i++;
			}
			
			$stringsForDiv[0] = $preparedString[6];
			$stringsForDiv[1] = $preparedString[7];
			$stringsForDiv[2] = $preparedString[1];
			$stringsForDiv[3] = '<div id="'.$preparedString[1].'" class="col-md-'.$preparedString[4].' col-sx-'.$preparedString[5].' '.$preparedString[3].'" >';
			$stringsForDiv[4] = $preparedString[2];
			$stringsForDiv[5] = $preparedString[8];
			$myBuilder->addDiv($stringsForDiv,$preparedString[0]); //contenuto di divElement,pageId
			
			
			return "added";
		}

		public function handleEditDiv($posts){
			$myBuilder = $this->builder;
			$preparedString = array();
			$i=0;
			foreach ($posts as $post) {
				$preparedString[$i] = $post;
				$i++;
			}
			$keys = array_keys($posts);
			$key = explode("-", $keys[0]);
			$pageId = explode("_", $key[0]);
			$divId = $key[1];
			$pageId[0] = $pageId[0].".php";
			$editDiv = $myBuilder->getDiv($divId,$pageId[0]); //divId, pageId
			$divContent = $editDiv->getDiv();
			$preparedString[0] = str_replace("Data: ", "", $preparedString[0]);
			$preparedString[1] = str_replace("CSS: ", "", $preparedString[1]);
			$preparedString[2] = str_replace("Div info: ", "", $preparedString[2]);
			$divContent[3] = $preparedString[2];
			$divContent[4] = $preparedString[0];
			$divContent[5] = $preparedString[1];
			$editDiv->setDiv($divContent);
			return "edit";
		}

	}

?>