<?php
    session_start();
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $command = $conn->prepare("DELETE FROM my_gafliceolevi.Itinerario WHERE Itinerario.Id=:Id;");
    $command->bindParam(':Id',$_POST['itinerarioId']);

    $command->execute();

    header("location: miei_viaggi.php");