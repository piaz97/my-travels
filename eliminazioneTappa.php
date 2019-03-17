<?php
session_start();
$conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$command = $conn->prepare("DELETE FROM my_gafliceolevi.Tappa WHERE Tappa.Itinerario=:itinerario 
                                    AND Tappa.Numero = :numero;");
$command->bindParam(':itinerario',$_POST['itinerarioId']);
$command->bindParam(':numero',$_POST['numeroTappa']);
$command->execute();

header("location: visualizza_itinerario.php?idItinerario=".$_POST['itinerarioId']);