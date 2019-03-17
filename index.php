<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Home sito di viaggi Mytravels" />
    <meta name="keywords" content="travels, journey, adventure" />
    <meta name="author" content="MyTravels Corporation" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="theme-color" content="#035c6e" />
	<link rel="stylesheet" type="text/css" href="css/stile.css"/>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>Scopri MyTravels</title>

    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>

    <div id="nav" class="nav-trasparent">
    <?php
        include_once("include/navbar-content.php");
    ?>
    </div>
	<div id="start">
        <div id="motto">
            <h1>La guida turistica che hai sempre sognato</h1>
        </div>

	</div>
    <nav id="breadcrumb" aria-label="Breadcrumbs">
        <span>Ti trovi in:&nbsp;</span>
        <ol>
            <li lang="en">Home</li>
        </ol>
    </nav>
    
    <div id="contenuto">
        <div class="sr-only" id="contenutoPagina"></div>
        <div id="iconBarContainer">
            <div id="iconBar">
                <h1>Benvenuti nella vostra guida turistica!</h1>
                <div class="iconBox">
                    <div class="iconContainer">
                        <a href="#spiegazione1">
                            <img alt="Icona viaggio" src="img/intro1.svg"/>
                        </a>
                    </div>
                    <p>VIAGGIA</p>
                </div>

                <div class="iconBox">

                    <div class="iconContainer">
                         <a href="#spiegazione2">
                             <img alt="Icona condividi" src="img/intro2.svg"/>
                        </a>
                    </div>
                    <p>CONDIVIDI</p>
                </div>

                <div class="iconBox">
                    <div class="iconContainer">
                        <a href="#spiegazione3">
                            <img alt="Icona guadagna" src="img/intro3.svg"/>
                        </a>
                    </div>
                    <p>GUADAGNA</p>
                </div>

                <h2>Esplora cosa offre <em>MyTravels</em></h2>
            </div>
        </div>
        <div id="bottomIconBar"></div>


        <div id="introContainer">

            <div class="introBox">
                <div class="introBoxText">
                    <h1>Stanco delle solite guide?</h1>
                    <p>Ti è mai capitato di giungere in un nuovo luogo ma non sapere cosa fare? Tutte le guide continuano a
                        segnalarti solo i soliti ristoranti e musei? Conosci fantasti posti che nessuno sta valorizzando? MyTravels è nato
                        proprio per rendere davvero speciali le tue avventure!</p>
                </div>
                <img alt="Foto panorama" src="img/discover.jpg"/>
            </div>
            <div class="introBox">
                <div class="introBoxText">
                    <h1>Scopri tesori nascosti</h1>
                    <p>I MyTravellers piú esperti e avventurosi condivideranno con te i loro segreti: panorami fantastici, angoli nascosti
                        nella natura ed escursioni uniche. Tutti gli elementi pensati per rendere indimenticabile la tua avventura ed esplorare
                        anche i posti non segnati nella solite mappe.</p>
                </div>
                <img alt="Foto panorama" src="img/photo2.jpg"/>
            </div>
            <div class="introBox">
                <div class="introBoxText">
                    <h1>Cosa aspetti!</h1>
                    <p>Iscriviti subito e comincia a sfruttare la tua guida personale. Segui gli itinerari che piú soddisfano i tuoi interessi
                        e comincia a condividere le tue esperienze. Scala le classifiche e ottieni fantastici regali per rendere i tuoi viaggi unici!</p>
                </div>
                <img alt="Foto panorama" src="img/find.jpg"/>
            </div>

        </div>
        
        <div id="guideContainer">
            <h1>Come funziona?</h1>
            <div id="guideBoxContainer">
                <div id="spiegazione1" class="guideBox">
                    <div class="guideIconContainer">
                        <img alt="Icona viaggia" src="img/intro1.svg"/>
                    </div>
                    <h2>Viaggia</h2>
                    <p> Inizia un nuovo viaggio! Sia che tu stia visitando grandi città o di passaggio in posto sperduto, prendi nota delle tappe più significative della tua avventura. Scatta foto e immortala ciò che più ti ha colpito dei luoghi che hai visitato.
                    </p>
                </div>

                <div  id="spiegazione2" class="guideBox">
                    <div class="guideIconContainer">
                        <img alt="Icona condividi" src="img/intro2.svg"/>
                    </div>
                    <h2>Condividi</h2>
                    <p>Aggiungi i luoghi che visiti alla tua guida e condividila con gli altri utenti. La tua opinione conta!
                    Diventa anche tu un MyTraveller e condividi le tue esperienze. </p>
                </div>

                <div  id="spiegazione3" class="guideBox">
                    <div class="guideIconContainer">
                        <img alt="Icona guadagna" src="img/intro3.svg"/>
                    </div>
                    <h2>Guadagna</h2>
                    <p>Scala la classifica grazie ai voti ricevuti dagli altri utenti e ottieni coupon sconto gratuiti per nuove esperienze di viaggio.</p>
                </div>
            </div>
        </div>


        <div id="buttonBoxContainer">
            <div  class="buttonBox">
                <a href="cerca.php">
                    <div>
                    Cerca  &rsaquo;
                    </div>
                </a>
            </div>
            <div  class="buttonBox">
                <a href="viaggio.php">
                    <div>
                        Condividi  &rsaquo;
                    </div>
                </a>
            </div>
        </div>

    <?php
        include_once("include/menuNoScript.php");
        include_once("include/backToTop.php");
    ?>
    
    </div>
    <?php
       include_once("include/footer.php");
       ?>
    <!-- leave it in the bottom to prevent errors, things must be loaded unless the script is not able to find them-->
    <script src="scripts/loginregistration.js"></script>
    <script src="scripts/registrazione-check.js"></script>
</body>
</html>

