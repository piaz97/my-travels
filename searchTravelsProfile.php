<?php
session_start();

$configs= include('include/config.php');
#preparare la query con i dati arrivati in post
#due possibilità, chiamata dal luogo o chiamata dal filtro

#chiamata da luogo
try {
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $richiesta = "SELECT Itinerario.Nome as Nome, Itinerario.Durata_ore as Durata_ore, 
    Itinerario.Durata_giorni as Durata_giorni, Itinerario.Costo as Costo, Itinerario.Luogo as Luogo,
    Itinerario.Creatore as Creatore, COUNT(*) as Tappe, AVG(Valutazione.Voto) as Valutazione FROM Itinerario 
    LEFT JOIN Tappa on Itinerario.Id = Tappa.Itinerario LEFT JOIN
    Valutazione on Itinerario.Id = Valutazione.Itinerario WHERE Creatore=:username GROUP BY Itinerario.Id";

    $query = $conn->prepare($richiesta);
    $query->bindParam(':username',$_SESSION['username']);
    $query->execute();


    $_SESSION["profileTravelsResults"] = $query->fetchAll(PDO::FETCH_BOTH);

    if(count($_SESSION["profileTravelsResults"])==0){
        unset($_SESSION["profileTravelsResultss"]);
    }
}
catch(PDOException $e)
{
    header("Location: lost.php");
}



