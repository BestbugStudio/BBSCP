<?php

	interface imoduleinstaller{
		function getSql();
		function readModConfig();
		function installModule($path);
		function getView();		
	}

?>