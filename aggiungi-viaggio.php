<?php
try {
    //errori: campi che non rispettano vincoli del database (manda in 404), errore nel caricamento del file
    session_start();
    $configs= include('include/config.php');
    //conn contains the connection object
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["Place"]) && is_string($_POST["Place"]) && strlen($_POST["Place"])<=64 &&
        isset($_POST["Name"]) && is_string($_POST["Name"]) && strlen($_POST["Name"])<=64 &&
        isset($_POST["Days"]) && is_numeric($_POST["Days"]) && (0<=$_POST["Days"]) && ($_POST["Days"]<=15) &&
        isset($_POST["Hours"]) && is_numeric($_POST["Hours"]) && (0<=$_POST["Hours"]) && ($_POST["Hours"]<=24) &&
        isset($_POST["Cost"]) && is_numeric($_POST["Cost"]) && (0<=$_POST["Cost"]) && ($_POST["Cost"]<=5000) &&
        isset($_FILES['Image']['name'])) {
        if (strlen(trim($_POST["Name"])) !== 0 && strlen(trim($_POST["Place"])) !== 0) {

            //una volta verificato che tutti i campi richiesti siano non vuoti procedo a scrivere la query senza binding
            //0 come stato indica che il viaggio è ancora in fase di modifica
            $stmt = $conn->prepare("INSERT INTO Itinerario (Luogo,Nome, Creatore, Durata_giorni, Durata_ore, Costo)
                        VALUES (:place ,:nome, :creator , :days, :hours, :cost)");

            //parte costruzione file imamgine della tappa
            $soglia_dimensione = 1024 * 1024 * 8;
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
                        $uploaddir = 'tripPictures/';

                        //get the number of the current travel
                        $querynum=$conn->prepare("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :database AND TABLE_NAME  = 'Itinerario' ");
                        $querynum->bindParam(':database', $configs->dbname);
                        $querynum->execute();
                        $temp=$querynum->fetchAll(PDO::FETCH_BOTH);
                        $numeroitinerario=$temp[0]["AUTO_INCREMENT"];
                        // The complete path/filename
                        $filename = $uploaddir . $numeroitinerario . $ext;

                        include_once("include/cropImmagine.php");
                        if (move_uploaded_file($_FILES['Image']['tmp_name'], $filename)) {
                            image_resize($filename, $filename, 300, 300, 1);
                            $_SESSION["successTripPicture"] = true;
                        } else {
                            $_SESSION["errorTripPicture"] = true;
                            header("Location: viaggio.php");
                            exit();
                        }

                    } else {
                        $_SESSION["errorTripPicture_1"] = true;
                        header("Location: viaggio.php");
                        exit();
                    }

                } else {
                    $_SESSION["errorTripPicture_3"] = true;
                    header("Location: viaggio.php");
                    exit();
                }
            } else {
                $_SESSION["errorTripPicture_2"] = true;
                header("Location: viaggio.php");
                exit();
            }

            //binding dei valori passati dal forum sulla query
            $stmt->bindParam(':place', $_POST["Place"]);
            $stmt->bindParam(':nome', $_POST["Name"]);
            $stmt->bindParam(':days', $_POST["Days"]);
            $stmt->bindParam(':hours', $_POST["Hours"]);
            $stmt->bindParam(':cost', $_POST["Cost"]);

            //bind per le variabili di sessione
            $stmt->bindParam(':creator', $_SESSION["username"]);

            //eseguo l'insert
            $stmt->execute();

            //vado alla pagina i miei viaggi dove sarà visualizzato il nuovo viaggio
            header("Location: miei_viaggi.php");
        }
        else {
            //setto errore per campi bianchi
            $_SESSION['errorTripBianco'] = true;
            header("Location: viaggio.php");
            exit();

        }
    }

    else {
        //errore nell'inserimento dei campi, è stato modificato l'html della pagina
        header("Location: lost.php");
    }

}
catch(PDOException $e)
{
    header("Location: lost.php");
}
