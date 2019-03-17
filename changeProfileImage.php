<?php
session_start();
$soglia_dimensione = 1024*1024*8;
if (isset($_SESSION['username'])) {
        //se il file esiste, cioè se ha un nome
        if ($_FILES['upload']['name']) {
            if ($_FILES['upload']['size'] < $soglia_dimensione) {
            //se l'estensione è una valida
                if (($_FILES['upload']['type']) == "image/jpeg" or
                    ($_FILES['upload']['type']) == "image/jpg" or
                    ($_FILES['upload']['type']) == "image/png") {

                    //salva soltanto in jpg sul server
                    $ext = '.jpg';

                    //seleziono la cartella per gli upload
                    $uploaddir = 'profilePictures/';

                    // The complete path/filename
                    $filename = $uploaddir . $_SESSION['username'] . $ext;

                    //controllo se c'è già una foto profilo, per evitare di averne due con due estensioni diverse. se c'è, la cancello
                    $oldPictureName = $uploaddir . $_SESSION['username'] . $ext;
                    unlink($oldPictureName);

                    include_once("include/cropImmagine.php");
                    if (move_uploaded_file($_FILES['upload']['tmp_name'], $filename)) {
                        image_resize($filename, $filename, 300, 300, 1);
                        $_SESSION["successProfilePicture"] = true;
                        header("Location: area_personale.php");
                    }
                    else {
                        $_SESSION["errorProfilePicture"] = true;
                        header("Location: area_personale.php");
                    }

                }
                else {
                    $_SESSION["errorProfilePicture_1"] = true;
                    header("Location: area_personale.php");
                }
        }
    }
        else {
        $_SESSION["errorProfilePicture_2"] = true;
        header("Location: area_personale.php");
    }
}
else {
    $_SESSION["errorProfilePicture_3"] = true;
    header("Location: area_personale.php");
}

