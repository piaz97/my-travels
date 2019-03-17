<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Classifica degli utenti di Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <title>Classifica</title>
	<link rel="stylesheet" type="text/css" href="css/stile.css"/>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    
	<div id="nav" class="nav-trasparent">
    <?php
        include_once("include/navbar-content.php");
    ?>
    </div>
	
	<div id="startClassifica">
        <div id="mottoClassifica">
            <h1>Classifica</h1>
        </div>
	</div>

    <nav id="breadcrumb" aria-label="Breadcrumbs">
        <span>Ti trovi in:&nbsp;</span>
        <ol>
            <li>Classifica</li>
        </ol>
    </nav>

    <div id="classificaContainer">
        <div id="contenutoPagina" class="sr-only"></div>
	<?php
			include_once("datiClassifica.php");
        ?>
    </div>
    
	<?php
            include_once("include/menuNoScript.php");
            include_once("include/footer.php");
            include_once("include/backToTop.php");
        ?>
    

    <!-- leave it in the bottom to prevent errors, things must be loaded unless the script is not able to find them-->
    <script src="scripts/loginregistration.js"></script>
    <script src="scripts/registrazione-check.js"></script>

	
</body>
</html>