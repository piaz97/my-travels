<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Visualizzazione dell'itinerario di un utente di Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>Visualizza itinerario</title>
    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>


<body>
<div id="nav" class="nav-color">
    <?php
    session_start();
    include_once("include/navbar-content.php");
    ?>
</div>


<?php
session_start();
$configs= include('include/config.php');
    //conn contains the connection object
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT Creatore, Id FROM Itinerario WHERE Id='".$_GET['idItinerario']."'");
    $stmt->execute();
    $risultato = $stmt->fetchAll(PDO::FETCH_BOTH);


    if ( !isset($_SESSION["username"]) ){
        echo "<div id=\"profileContainer\">";
        include_once("include/errore-non-loggato.php");
        echo "</div>";
    }
    else{
        if ( isset($_GET['idItinerario']) && !empty($risultato) && $risultato[0]['Creatore'] == $_SESSION["username"] ){
            $_SESSION["iditinerario"]=$_GET['idItinerario'];
            $_SESSION["idItinerarioCommento"]=$_GET['idItinerario'];
            include_once ("visualizza_itinerario_content.php");
        }
        else{
            echo "<div id=\"profileContainer\">";
                include_once("include/profileNavbar.php");
                echo "<div id=\"rightItinerario\">";
                    echo "
                        <div id=\"notLoggedContainer\">
                            <p><em>Oh no!</em> Sembra che tu non abbia fatto questo viaggio, oppure appartiene ad un altro traveller!
                             Torna ai <a href='miei_viaggi.php'>tuoi viaggi!</a>
                            </p>
                        </div>
                        ";
                echo "</div>
                 </div>";
        }
    }


    ?>

<?php

include_once("include/footer.php");
include_once("include/backToTop.php");
?>

<script type="text/javascript" src="scripts/loginregistration.js"></script>
<script type="text/javascript" src="scripts/registrazione-check.js"></script>
</body>
</html>