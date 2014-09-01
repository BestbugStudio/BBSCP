<?php

	/**
	*	classe che si occupa di fare da controller tra le varie classi del front-end. Al momento si occupa solo di recuperare le pagine php
	*	salvate e di eseguirle per poi restituirle. Attualmente ha implementato un tentativo di singleton probabilmente da eliminare.
	*/

	interface imaker{
		public static function getMaker();
		public function getBody($idPage);
		public function getpage($idPage);
	}
?>