<?php

	/**
	*	Controller della parte backend del bbscp - fe. Si occupa di dialogare con la pagina di amministrazione e con le varie classi adette
	*	ai lavori [ESEMPIO DIVVECTOR] 
	*/

	interface ibuilder{
		//WIP: funzione che gestisce quello che c'è ora in index.php del backend
		
		public function savePage($idPage);
		public function addDiv($strings,$idPage);
		public static function getBuilder($workname);
		public function addPage($idPage);
		public function write($elementToWrite,$pathToWrite);
		public function &getDiv($idDiv,$idPage);
		public function getAllDivs($idPage);
		public function setUpFormEditing();
		public function handleStuff($post);
		public function recurse_copy($src,$dst);
		public function saveWorkspace();
	}

?>