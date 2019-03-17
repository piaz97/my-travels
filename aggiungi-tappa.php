<?php
try {
    session_start();
    $configs= include('include/config.php');
    //conn contains the connection object
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["Name"]) && is_string($_POST["Name"]) && strlen($_POST["Name"])<=64 &&
        isset($_POST["Description"]) && is_string($_POST["Description"]) && strlen($_POST["Description"])<=512 &&
        isset($_POST["Evaluation"]) && is_numeric($_POST["Evaluation"]) && (0<$_POST["Evaluation"])  && ($_POST["Evaluation"]<=5) ){
        if( strlen(trim($_POST["Name"]))!==0 &&  strlen(trim($_POST["Description"]))!==0) {
            if (!empty($_POST["Address"]) && is_string($_POST["Address"]) &&  strlen(trim($_POST["Address"]))!==0 && strlen($_POST["Address"])<=256 &&
                !empty($_POST["Latitude"]) && is_numeric($_POST["Latitude"]) &&
                !empty($_POST["Longitude"]) && is_numeric($_POST["Longitude"]) ) {

                //una volta verificato che tutti i campi richiesti siano non vuoti procedo a scrivere la query senza binding
                $stmt = $conn->prepare("INSERT INTO Tappa (Itinerario, Voto, Commento, Nome, Latitudine, Longitudine, Indirizzo)
                                VALUES (:itinerario, :rate, :comm, :nome, :lat, :long, :addr)");

                //parte costruzione file imamgine della tappa
                $soglia_dimensione = 1024*1024*8;

                //se il file esiste, cioè se ha un nome
                if ($_FILES['Image']['name']) {
                    if ($_FILES['Image']['size'] < $soglia_dimensione) {
                        //se l'estensione è una valida
                        if (($_FILES['Image']['type']) == "image/jpeg" or
                            ($_FILES['Image']['type']) == "image/jpg" or
                            ($_FILES['Image']['type']) == "image/png") {

                            //salva soltanto in jpg sul server
                            $ext = '.jpg';

                            //seleziono la cartella per gli upload
                            $uploaddir = 'travelStopPictures/';

                            //get the number of the current travelstop
                            $querynum=$conn->prepare("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :database AND TABLE_NAME  = 'Tappa' ");
                            $querynum->bindParam(':database', $configs->dbname);
                            $querynum->execute();
                            $temp=$querynum->fetchAll(PDO::FETCH_BOTH);
                            $numerotappa=$temp[0]["AUTO_INCREMENT"];
                            // The complete path/filename
                            $filename = $uploaddir . $_SESSION['iditinerario'] . "_" . $numerotappa . $ext;

                            include_once("include/cropImmagine.php");
                            if (move_uploaded_file($_FILES['Image']['tmp_name'], $filename)) {
                                image_resize($filename, $filename, 300, 300, 1);
                                $_SESSION["successStopPicture"] = true;
                            }
                            else {
                                $_SESSION["errorStopPicture"] = true;
                                header("Location: tappa.php");
                                exit();
                            }
                        }
                        else {
                            $_SESSION["errorStopPicture_1"] = true;
                            header("Location: tappa.php");
                            exit();
                        }
                    }
                    else{
                        $_SESSION["errorStopPicture_2"] = true;
                        header("Location: tappa.php");
                        exit();
                    }
                }
                else {
                    $_SESSION["errorStopPicture_3"] = true;
                    header("Location: tappa.php");
                    exit();
                }

                //binding dei valori passati dal forum sulla query
                $stmt->bindParam(':rate', $_POST["Evaluation"]);
                $stmt->bindParam(':comm', $_POST["Description"]);
                $stmt->bindParam(':nome', $_POST["Name"]);
                $stmt->bindParam(':lat', $_POST["Latitude"]);
                $stmt->bindParam(':long', $_POST["Longitude"]);
                $stmt->bindParam(':addr', $_POST["Address"]);
                //bind per la variaible di sessione dell'id dell itinerario a cui stiamo aggiungendo
                $stmt->bindParam(':itinerario', $_SESSION["iditinerario"]);
                //eseguo l'insert
                $stmt->execute();
                //manda alla pagina visualizzazione itinerario col corretto paramentro in get
                header("Location: visualizza_itinerario.php?idItinerario=" . $_SESSION["iditinerario"]);
                exit();
            }
            else {
                //non è stato scelto un luogo correttamente
                $_SESSION["errorPlace"] = true;
                header("Location: tappa.php");
                exit();
            }
        }
        else {
            // dun campo contiene solo con spazi
            $_SESSION["errorTappaBianco"] = true;
            header("Location: tappa.php");
            exit();
        }

    }
    else {
        header("Location: lost.php");
        exit();
    }
}
catch(PDOException $e)
{
    header("Location: lost.php");
}
