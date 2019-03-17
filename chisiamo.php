<!DOCTYPE html>
<html lang="it">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Chi sono i creatori di Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <title>Chi siamo</title>
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
	
	<div id="startAbout">
        <div id="mottoAbout">
            <h1>Chi siamo</h1>
        </div>
	</div>

    <nav id="breadcrumb" aria-label="Breadcrumbs">
        <span>Ti trovi in:&nbsp;</span>
        <ol>
            <li>Cerca</li>
        </ol>
    </nav>
	<div id="aboutContainer">
        <div id="contenutoPagina" class="sr-only"></div>
		<div class="aboutBox">       
			<div class="about">    
				<h1>Noi</h1>
				<p>Siamo quattro studenti della facoltá di informatica dell'Universitá di Padova, amanti del viaggio e dell'esplorazione.</p>
				<div class="avatar">
                    <figure>
                    	<img src="img/bordin.svg" alt="Foto di Matteo Bordin"/> <figcaption>Matteo Bordin</figcaption>
                    </figure>
                    <figure>
                    	<img src="img/sam.svg" alt="Foto di Samuele Giuliano Piazzetta"/> <figcaption>Samuele Giuliano Piazzetta</figcaption>
                    </figure>
                    <figure>
                   		<img src="img/gian.svg" alt="Foto di Gianluca Lain"/> <figcaption>Gianluca Lain</figcaption>
                   	</figure>
                    <figure>
						<img src="img/squeri.svg" alt="Foto di Matteo Squeri"/> <figcaption>Matteo Squeri</figcaption>
					</figure>
                </div>
			</div>
			<div class="about">
				<h1>Il problema</h1>
				<p>L'idea di questo sito é nata durante l'organizzazione di diversi viaggi in giro per l'Europa. <br/>
                    Cercando dei consigli sul web per poter organizzare dei tour, abbiamo notato che i luoghi suggeriti
                    dai diversi siti di viaggio erano sempre gli stessi, dai ristoranti ai musei. Non c'era traccia di
                    angoli panoramici, pub particolari o suggerimenti che potevano indicarci solo gli abitanti locali
                    o turisti veramente curiosi.
                </p>
            </div>
			<div class="about">
				<h1>La nostra soluzione</h1>
				<p>Questo sito inivita i viaggiatori, principianti ed esperti, a creare degli itinerari di viaggio per poter far conoscere nuovi luoghi e servizi ad altri visitatori in modo tale da vivere fino in fondo il viaggio che si intraprende.</p>
			</div>
		</div>
	</div>
	
	
	<?php
            include_once("include/menuNoScript.php");
            include_once("include/footer.php");
            include_once("include/backToTop.php");
        ?>
    

    <!-- leave it in the bottom to prevent errors, things must be loaded unless the script is not able to find them-->
    <script  src="scripts/loginregistration.js"></script>
    <script  src="scripts/registrazione-check.js"></script>

	
</body>
</html>