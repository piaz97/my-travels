<?php
session_start();
$configs= include('include/config.php');
#preparare la query con i dati arrivati in post
try {
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    #devo fare il check del commento ed inserire
    $commento = $_POST['commento'];
    $username = $_SESSION['username'];
    $itinerario = $_SESSION['idItinerarioCommento'];
    if ( is_string($commento) &&  strlen(trim($commento))!==0 && strlen($commento)<=512){
        #se il commento supera il controllo allora deve essere inserito
        $inserimento = "INSERT INTO Commento (Utente, Itinerario, Commento)
                               VALUE (:username, :idItinerario, :commento)";
        $query = $conn->prepare($inserimento);
        $query->bindParam(':username',$username);
        $query->bindParam(':idItinerario',$itinerario);
        $query->bindParam(':commento',$commento);
        $query->execute();
        #unsetto la variabile che potrebbe essere stata usata precedenetmente
        unset($_SESSION['error-comment']);

    }
    else{
        #se il commento non va bene allora ricarico la pagina ai commenti con l'errore
        $_SESSION['error-comment'] = 1;
    }
    header("Location: {$_SERVER['HTTP_REFERER']}#containerCommenti");
}
catch(PDOException $e) {
    header("Location: lost.php");
}




