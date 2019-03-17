<?php
session_start();
$conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$command = $conn->prepare("DELETE FROM my_gafliceolevi.Utente WHERE Username = :username;");
$command->bindParam('username',$_SESSION['username']);

$command->execute();

session_unset();
// destroy the session
session_destroy();
header("location: index.php");