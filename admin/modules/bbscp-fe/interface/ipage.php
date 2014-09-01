<?php
	/**
	*	Struttura che contiene i dati di una pagina [NOTA: CSS E DIV], ha come metodi dei setter e getter dei suoi attributi e basta
	*/
	interface ipage{
		public function get($idElement);
		public function set($idElement,$item);
	}

?>