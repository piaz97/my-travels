<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Visualizzazione dell'itinerario di un utente di Mytravels">
    <meta name="keywords" content="travels, journey, adventure">
    <meta name="author" content="MyTravels Corporation">
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>

    <title>Visualizza itinerario</title>

    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div id="nav" class="nav-trasparent">
    <?php
    include_once("include/navbar-content.php");
    ?>
</div>
<div id="ViaggioCover">
    <div id="ViaggioTitolo">
    </div>
</div>

<nav id="breadcrumb" aria-label="Breadcrumbs">
    <span>Ti trovi in:&nbsp;</span>
    <ol>
        <li><a href="cerca.php">Cerca</a></li>
        <li>Visualizza itinerario <?php echo $_POST['itinerarioId'];?></li>
    </ol>
</nav>

<?php
    session_start();
    $configs= include('include/config.php');
    //conn contains the connection object
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `Itinerario` WHERE Id=:itinerario");
    $stmt->bindParam(":itinerario",$_GET["idItinerario"]);
    $stmt->execute();
    $risultato = $stmt->fetchAll(PDO::FETCH_BOTH);


    if ( isset($_GET['idItinerario']) && count($risultato)!=0 ){

        include_once("visualizza_itinerario_cerca_content.php");
    }
    else{
        echo "
                            <div id=\"notLoggedContainer\">
                                <p><em>Oh no!</em> Sembra che questo viaggio non esista ancora, perchè non cominci tu?
                                 <a href='viaggio.php'>Inizia a viaggiare!</a>
                                </p>
                            </div>
                            ";
    }
?>

<?php
include_once("include/menuNoScript.php");
include_once("include/footer.php");
include_once("include/backToTop.php");
?>


<!-- leave it in the bottom to prevent errors, things must be loaded unless the script is not able to find them-->
<script type="text/javascript" src="scripts/loginregistration.js"></script>
<script type="text/javascript" src="scripts/registrazione-check.js"></script>
<script type="text/javascript" src="scripts/getfilename.js"></script>

</body>
</html>
