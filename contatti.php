<!DOCTYPE html>
<html lang="it">

<head>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Contatti per i creatori di Mytravels">
    <meta name="keywords" content="travels, journey, adventure">
    <meta name="author" content="MyTravels Corporation">
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <title>Contatti</title>
	<link rel="stylesheet" type="text/css" href="css/stile.css"/>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <script src="scripts/menu-mobile.js"></script>
	<script src="scripts/mappa_contatti.js"> </script>



    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async="async" defer="defer"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAKF6I6FaWFdnsDv6Rxxu6nxCQZNrTWaw&callback=initMap">
    </script>
    <script type="text/javascript" src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	
</head>
<body>

    <div id="nav" class="nav-trasparent">
	    <?php
	        include_once("include/navbar-content.php");
	    ?>
    </div>
	<div id="startContatti">
        <div id="mottoContatti">
            <h1>Contattaci</h1>
			<p>
        </div>
	</div>

    <nav id="breadcrumb" aria-label="Breadcrumbs">
        <span>Ti trovi in:&nbsp;</span>
        <ol>
            <li>Contatti</li>
        </ol>
    </nav>
	
	<div id="contattiContainer">
        <div id="contenutoPagina" class="sr-only"></div>
        <div class="sr-only" id="contenutoPagina"></div>
		<div class="contattiBox">      
			<div class="Contatti">       
				<h1>Chiama:</h1>
				<p>Numero: 04023 123456</p>
				<p>Giorni: da Lunedì a Venerdì </p>
				<p>Orari: dalle 8:00 alle 17:00</p>
			</div>
			<div class="Contatti">
				<h1>Invia un e-mail a:</h1>
				<p class="mail" onclick = "parent.location='mailto:mytravels@gmail.com'" style ="cursor:pointer">mytravels@gmail.com</p>
			</div>
			<div class="Contatti">
				<h1>Social</h1>
				<div class="socialIcon">
                    <a href="https://www.youtube.com/watch?v=CdrWv8gfoLo"><img src="img/facebook.svg" alt="Facebook"/></a>
                    <a href="https://www.instagram.com/mat_bord/"><img src="img/instagram.svg" alt="Instagram"/></a>
                    <a href="https://www.youtube.com/watch?v=CdrWv8gfoLo"><img src="img/twitter.svg" alt="Twitter"/></a>
                </div>
			</div>
		</div>
		<div class="contattiBox">
			<div class="Contatti">
				<h1>Posizione sede legale:</h1>
				<p>Torre Archimede, Via Trieste, 6335121 Padova PD </p>
				<div id="mapContatti"></div>
			</div>
		</div>
	</div>


    <?php
            include_once("include/menuNoScript.php");
            include_once("include/footer.php");
            include_once("include/backToTop.php");
     ?>
    <!-- leave it in the bottom to prevent errors, things must be loaded unless the script is not able to find them-->
    <script type="text/javascript"  src="scripts/loginregistration.js"></script>
    <script type="text/javascript" src="scripts/registrazione-check.js"></script>
</body>
</html>