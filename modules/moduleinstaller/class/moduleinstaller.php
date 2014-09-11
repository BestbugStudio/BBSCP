<?php

	class moduleinstaller implements imoduleinstaller{
		function getSql();
		function readModConfig();
		function installModule($path);
		function getView();
	}
?>