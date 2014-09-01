<?php

	/*
		Interfaccia che si occupa di della struttura dati che conterrà i div
	*/

	interface idivvector{
		public function hasMoreElement();
		public function getNextElement();
		public function insertElement($element);
		public function getElementAt($pos);
		public function setIndexSearchTo($pos);
		public function orderElement();//Interface contract, non posso metterlo privato nell'interfaccia
		public function getAllElements();
	}
?>