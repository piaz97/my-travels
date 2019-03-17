<?php
session_start();
$configs= include('include/config.php');
#preparare la query con i dati arrivati in post
try {
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    if (!isset($_SESSION["username"])){
        echo "LOGGATI PER POTER FARE UNA VALUTAZIONE";
    }
    //Controllo se è stata data una valutazione, se è valida (tra 1 e 5) e se non ho già dato una valutazione per quell'itinerario
    else{
        $stmt = $conn->prepare("SELECT * FROM Valutazione WHERE Itinerario=:itinerario AND Utente=:utente");
        $stmt->bindParam(":utente",$_SESSION["username"]);
        $stmt->bindParam(":itinerario",$_SESSION["idItinerarioCommento"]);
        $stmt->execute();
        $risultato = $stmt->fetchAll(PDO::FETCH_BOTH);

        if (isset($_POST["Evaluation"]) && 0<$_POST["Evaluation"] && $_POST["Evaluation"]<6 && count($risultato)==0 && is_numeric($_POST["Evaluation"])){
            $stmt = $conn->prepare("INSERT INTO Valutazione (Utente, Itinerario, Voto) VALUES (:username, :itinerario, :valutazione)");
            $stmt->bindParam(":username", $_SESSION["username"]);
            $stmt->bindParam(":itinerario",$_SESSION["idItinerarioCommento"]);
            $stmt->bindParam(":valutazione",$_POST["Evaluation"]);
            $stmt->execute();

        }
    }

    header("Location: {$_SERVER['HTTP_REFERER']}#containerCommenti");
}
catch(PDOException $e) {
    header("Location: lost.php");
}