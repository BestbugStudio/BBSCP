<?php

	/*
		Interfaccia che si occupa della creazione di form
	*/

	interface iformmaker{
		public function makeOptList($arrayString,$nameLabel,$nameOpt);
		public function insertText($text);
		public function makeTextAreaList($listTexts,$listIds);
		public function insertTextBox($id);
		public function insertButtom($type,$name);
		public function getForm();
	}
?>