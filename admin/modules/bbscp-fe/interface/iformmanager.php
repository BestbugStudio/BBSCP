<?php

	/**
	*	classe addetta a gestire i vari tipi di form implementati [NOTA: AL MOMENTO SOLO AGGIUNTA E EDIT DI UN DIV]
	*/
	interface iformmanager{
		public static function getFormManager($builder);
		public function handlePostDiv($post);
		public function handleAddDiv($post);
		public function handleEditDiv($post);
	}

?>