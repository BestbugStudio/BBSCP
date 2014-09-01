<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Bestbugstudio website</title>

	    <!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	   	<?php 

			function loaderMaker ($classname){
				$filename = "./".$classname.".php";
				if(file_exists($filename))
					include_once($filename);
			}
			function loaderInterface ($classname){
				$filename = "./interface/".$classname.".php";
				if(file_exists($filename))
					include_once($filename);
			}


			if(isset($_GET['idPage']))
				$idPage = $_GET['idPage'].".css";
			else
				$idPage = "home.css";

			spl_autoload_register('loaderMaker');
			spl_autoload_register('loaderInterface');
			echo '<link href="css/'.$idPage.'" rel="stylesheet">';

	    ?>
	</head>
	<body>
		<?php  

			$MAKER = maker::getMaker();

			if(isset($_GET['idPage']))
				$idPage = $_GET['idPage'];
			else
				$idPage = "home.php";

			echo $MAKER->getPage($idPage);
		?>		
	</body>
</html>