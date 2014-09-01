<?php

	/*
		Interfaccia che si occupa di della struttura dati che gestirà il singolo div
	*/

	interface idivelement{
		public function getHtml();
		public function getDiv();
		public function setDiv($strings);
		public function getParent();
		public function setParent($parent);
		public function getId();
		public function setId($id);
		public function getChild();
		public function setChild($child);
		public function getCss();
		public function setCss($css);
		public function getContent();
		public function setContent($content);
	}
?>