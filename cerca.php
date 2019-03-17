<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Cerca vaiggi in Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>Cerca un itinerario</title>
    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
    <div id="nav" class="nav-trasparent">
        <?php
            include_once("include/navbar-content.php");
        ?>
    </div>
    <div id="startSearch">
        <div id="contenutoPagina" class="sr-only" ></div>
        <div id="mottoSearch">
            <div class="researchBarContainer">
                <form action="cerca.php" method="post" aria-label="Ricerca itinerario">
                    <label for="luogo" class="sr-only">Barra di ricerca</label>
                    <input class="reserachBar" id="luogo" placeholder="Cerca (es. Padova)" name="luogo"/>
                    <button type="submit"><img src="img/lens.svg" alt="Cerca"/></button>
                </form>
            </div>
        </div>
    </div>
    <div class="hideAndShowFilters">
        <input  type="checkbox" id="filtersCheckbox"/>
        <label class="hideAndShowLabel" for="filtersCheckbox"><span>Filtri</span> <img src="img/arrow-down-sign-to-navigate.svg" alt="apri filtri"/></label>
        <div class="coolFilters">
            <div class="spaceContainer"><div id="leftSpace"></div></div>
            <div id="filtersContainer">

                <form action="cerca.php?page=1" method="post" aria-label="Filtri di ricerca">
                    <div class="sliderContainer">
                        <label for="maxCost">Costo Massimo (0-5000 &euro;)</label>
                        <input type="range" min="0" max="5000"  value="50" class="slider script-inline" id="maxCost"/>
                        <label for="maxCostValue" class="sr-only">Costo massimo</label>
                        <input type="number" id="maxCostValue"  name="maxCost" min="0" max="5000" value="<?php if(isset($_SESSION["maxCost"])&& !empty($_SESSION["maxCost"])) echo $_SESSION["maxCost"];
                        else echo 5000; ?>" class="showSliderValue" />
                    </div>
                    <div class="sliderContainer">
                        <label for="maxTappe">Numero massimo di tappe (0-15)</label>
                        <input type="range" min="0" max="15" value="5" class="slider script-inline" id="maxTappe"/>
                        <label for="maxTappeValue" class="sr-only">Numero massimo tappe</label>
                        <input type="number" id= "maxTappeValue" name="maxTappe" min="0" max="15" value="<?php if(isset($_SESSION["maxTappe"])&& !empty($_SESSION["maxTappe"])) print_r($_SESSION["maxTappe"]);
                        else echo 15; ?>" class="showSliderValue" />
                    </div>
                    <div class="sliderContainer">
                        <label for="durataOre">Durata max ore (0-24)</label>
                        <input type="range" min="0" max="24" value="10" class="slider script-inline" id="durataOre"/>
                        <label for="durataOreValue" class="sr-only">Durata max in ore</label>
                        <input type="number" id="durataOreValue" name="durataOre" min="0" max="24" value="<?php if(isset($_SESSION["durataOre"]) && !empty($_SESSION["durataOre"])) echo $_SESSION["durataOre"];
                        else echo 24; ?>" class="showSliderValue"  />
                    </div>
                    <div class="sliderContainer">
                        <label for="durataGiorni">Durata giorni (0-15)</label>
                        <input type="range" min="0" max="15" value="0" class="slider script-inline" id="durataGiorni"/>
                        <label for="durataGiorniValue" class="sr-only"> Durata giorni</label>
                        <input type="number" id="durataGiorniValue" name="durataGiorni" min="0" max="15" value="<?php if(isset($_SESSION["durataGiorni"]) && !empty($_SESSION["durataGiorni"])) echo $_SESSION["durataGiorni"];
                        else echo 15; ?>" class="showSliderValue"/>
                    </div>
                    <button type="submit" id="buttonCerca">Filtra</button>
                </form>

            </div>
            <div class="spaceContainer"><div id="rightSpace"></div></div>
        </div>
    </div>
    <nav id="breadcrumb" aria-label="Breadcrumbs">
        <span>Ti trovi in:&nbsp;</span>
        <ol>
            <li>Cerca</li>
        </ol>
    </nav>
    <div class ="searchContent" id="searchContent">
        <?php
            session_start();
            include_once ("funzioni.php");
            include_once ('searchResults.php');
            searchResults();
            $ris = stampaItinerariRicerca();
            echo "$ris";
            include("include/pagination.php");
        ?>
    </div>

    <?php
        include_once("include/menuNoScript.php");
        include_once("include/footer.php");
        include_once("include/backToTop.php");
    ?>

    <script src="scripts/loginregistration.js"></script>
    <script src="scripts/registrazione-check.js"></script>
    <script src="scripts/slidertext.js"></script>
    <script src="scripts/slidertext.js"></script>
</body>
</html>

