<?php
    session_start();

    #preparare la query con i dati arrivati in post
    #due possibilità, chiamata dal luogo o chiamata dal filtro

    #chiamata da luogo
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if(isset($_POST["luogo"]) && !empty($_POST["luogo"])){
        $_SESSION["luogo"] = $_POST["luogo"];
    }
    else if(isset($_POST["maxCost"]) && isset($_POST["maxTappe"]) &&
            isset($_POST["durataOre"]) && isset($_POST["durataGiorni"])){
        $_SESSION["maxCost"] = $_POST["maxCost"];
        $_SESSION["maxTappe"] = $_POST["maxTappe"];
        $_SESSION["durataOre"] = $_POST["durataOre"];
        $_SESSION["durataGiorni"] = $_POST["durataGiorni"];
    }
    else{
        unset($_SESSION["searchResults"]);
        exit();
    }

    #sanare i dati in caso qualcosa non vada bene ed rimadare un errore di invalid data


    #se arrivo qua qualcosa da fare ce l'ho
    $richiesta = "SELECT *,
                COUNT(*) as Tappe,  
                AVG(Valutazione.Voto) as Valutazione
                FROM Itinerario 
                JOIN Tappa on Itinerario.Id = Tappa.Itinerario
                JOIN Valutazione on Itinerario.Id = Valutazione.Itinerario
                WHERE
                 ";
    #aggiungo il luogo dell'itinerario
    $luogo = "";
    if(isset($_POST["luogo"])){
        $luogo = $_POST["luogo"];
    }
    else if(isset($_SESSION["luogo"])){
        $luogo = $_SESSION["luogo"];
    }
    else{
        exit();
    }
    $richiesta.=" Itinerario.Luogo LIKE ".$luogo."%";

    if(isset($_SESSION["maxCost"])){
        #allora vuol dire che tutte e 4 sono settate
        $richiesta.= " AND Itinerario.Costo <= ".$_SESSION["maxCost"].
                     " AND Itinerario.Durata.giorni*24+Itinerario.Durata_ore<=".
            ($_SESSION["durataGiorni"]*24+$_SESSION["durataOre"]);
    }
    $richiesta.= " GROUP BY Itinerario.Id
                    HAVING COUNT(*)<=".$_SESSION["maxTappe"].
                " ORDER BY Valutazione DESC";



    $query = $conn->prepare($richiesta);
    $query->execute();
    #salvare i risultati si $_SESSION["searchResults"]

    $_SESSION["searchResults"] = $query->fetchAll( PDO::FETCH_BOTH);

    echo($query);
    #reindirizzare a cerca.php
    header("Location: cerca.php");

?>



