<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

include dirname(__FILE__).'/../abspath.php';
include ABSOLUTEPATH.'/utilities/database.php';
include_once ABSOLUTEPATH.'/install/install.php';
include ABSOLUTEPATH.'/config/query.php';

	interface modelinterface{
		public function getObjectData();
		public function getId();
		public function getFromId($id);
		public static function getAllData();
		public function addNewData();
		public function updateData();
		public function deleteData();
	}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>