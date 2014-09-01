

<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>BBSCP - Frontend maker ALPHA v0.1</title>

	    <!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<?php  
			
			/*
			*	Ore spese: 24
			*	Implementato: possibilità di aggiungere un div,riaprire un progetto,logica della struttura divElement,divVector e page
			*	Prossimo elemento da implementare: aggiornamento dei div [morirò lo so]
			*/
			global $myBuilder;

			//MODULO AUTOCARICAMENTO CLASSI MANCANTI
			function loaderBuilder ($classname){
				$filename = "../".$classname.".php";
				if(file_exists($filename))
					include_once($filename);
			}
			function loaderUtilities ($classname){
				$filename = "../utilities/".$classname.".php";
				if(file_exists($filename))
					include_once($filename);
			}
			function loaderLayout($classname){
				$filename = "../layout/".$classname.".php";
				if(file_exists($filename))
					include_once($filename);;
			}
			function loaderInterface($classname){
				$filename = "../interface/".$classname.".php";
				if(file_exists($filename))
					include_once($filename);
			}
			spl_autoload_register('loaderUtilities');
			spl_autoload_register('loaderInterface');
			spl_autoload_register('loaderLayout');
			spl_autoload_register('loaderBuilder');

			//La sessionne va inizializata DOPO aver fatto lo script di autoload
			if(isset($_GET['SID'])){
				session_start($_GET['SID']);
			}else
				session_start();
			
			if(isset($_POST['addDiv']) || isset($_POST['editDiv'])){ //NOTA: va gestito il caso in cui ci siano già dei post, la cosa più semplice è di fare dei form diversi uno che si occupa della gestione delle modifice e il secondo dell'aggiunta dei div...[che palle]
				//print_r($_SESSION);
				$myBuilder = $_SESSION['myBuilder'];
				$myBuilder->handleStuff($_POST);
				echo $myBuilder->setUpFormEditing();
				echo "post gestito!";
			}elseif (isset($_POST['savePage'])) {
				$myBuilder = $_SESSION['myBuilder'];
				$myBuilder->savePage($_POST['pageId']);
				echo "pagina".$_POST['pageId']." salvata!";
				echo $myBuilder->setUpFormEditing();
			}elseif(isset($_POST['workname'])){
				if(is_dir("../".$_POST['workname'])){
					echo "la folder esiste già!Apro il vecchio progetto!";


				if(isset($_GET['SID'])){
					$myBuilder = $_SESSION['myBuilder'];
				}else{
					$pathToRead = "../".$_POST['workname']."/class/website.prog";
					$builderData = file_get_contents($pathToRead); 
					$myBuilder = unserialize($builderData);
				}

					echo $myBuilder->setUpFormEditing();
				}else{
					echo "la folder non esiste già, la creo ora!";
					mkdir("../".$_POST['workname']);
					mkdir("../".$_POST['workname']."/class");
					mkdir("../".$_POST['workname']."/css");
					mkdir("../".$_POST['workname']."/fonts");
					mkdir("../".$_POST['workname']."/js");
					mkdir("../".$_POST['workname']."/interface");
					$myBuilder = builder::getBuilder($_POST['workname']);

					copy("../standard/frontend/index.php","../".$_POST['workname']."/index.php");
					copy("../standard/frontend/maker.php", "../".$_POST['workname']."/maker.php");
					$myBuilder->recurse_copy("../standard/frontend/css", "../".$_POST['workname']."/css");
					$myBuilder->recurse_copy("../standard/frontend/fonts", "../".$_POST['workname']."/fonts");
					$myBuilder->recurse_copy("../standard/frontend/js", "../".$_POST['workname']."/js");
					$myBuilder->recurse_copy("../standard/interface", "../".$_POST['workname']."/interface");

					$myBuilder->addPage("home.php");

					echo $myBuilder->setUpFormEditing();
				}
				
				$_SESSION['myBuilder'] = $myBuilder;
				//$GLOBALS['myBuilder'] = $myBuilder;
				
			}else{
				if(isset($_GET['SID'])){
					echo'<form name="startProject" method="POST" action="index.php?SID='.$_GET['SID'].'">
							<input type="text" name="workname"></input>
							<input type="submit"  value="aggiungi nuovo progetto/riapri vecchio progetto">
						</form>';
				}else{
					echo'<form name="startProject" method="POST" action="index.php">
							<input type="text" name="workname"></input>
							<input type="submit"  value="aggiungi nuovo progetto/riapri vecchio progetto">
						</form>';
				}

			}
			
			/*<p><h1>Hello World </h1><h2>From bestbugstudio</h2></p>*/
				
		?>		

	</body>
</html>