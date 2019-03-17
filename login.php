<?php
$configs= include('include/config.php');
//$conn contains the connection obj
try {
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //4 casi disponibili, da ajax o non e funziona o no
    if(isset($_POST["username"]) && isset($_POST["password"])){
        #solo se passa tutti i check anche server side
        $stmt = $conn->prepare("SELECT * FROM Utente  WHERE Username=:username");
        $stmt->bindParam(':username', $_POST["username"]);
        $stmt->execute();
        if($stmt->rowCount()>0){
            //imposta le variabili di sessione
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($_POST["password"], $data["Password"] )) {
                $_SESSION["username"] = $data["Username"];
                $_SESSION["nome"] = $data["Nome"];
                $_SESSION["cognome"] = $data["Cognome"];
                $_SESSION["mail"] = $data["Mail"];
                $_SESSION["dataNascita"] = $data["Data_nascita"];
                $_SESSION["sesso"] = $data["Sesso"];
                $_SESSION["reputazione"] = $data["Reputazione"];

                /*$punteggio = $conn->prepare("SELECT SUM(voto) as Reputaz  FROM Itinerario JOIN Valutazione WHERE Creatore = :username");
                $punteggio->bindParam(':username', $_POST["username"]);
                $punteggio->execute();
                $reputazione = $punteggio->fetch(PDO::FETCH_ASSOC)['Reputaz'];
                if ($reputazione != NULL)
                    $_SESSION["reputazione"] = $reputazione;
                else
                    $_SESSION["reputazione"] = 0;*/
                if (isset($_POST["script"]))
                    //la pagina penserà da sola a refreshare
                    echo 1;
                else {
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'cerca.php';
                    header("Location: https://$host$uri/$extra");
                }
                exit();
            }
            else{
                if(isset($_POST["script"]))
                    echo 0;
                else{
                    //allora torno alla pagina di login
                    $host  = $_SERVER['HTTP_HOST'];
                    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'login-page.php';
                    $_SESSION["loginMessage"] = 1; // controllo dopo sul login cosa stampare a video
                    header("Location: https://$host$uri/$extra");
                }
            }
        }
        else{
            if(isset($_POST["script"]))
                echo 0;
            else{
                //allora torno alla pagina di login
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'login-page.php';
                $_SESSION["loginMessage"] = 1; // controllo dopo sul login cosa stampare a video
                header("Location: https://$host$uri/$extra");
            }
        }


    }
    else{
        //allora non ho settato username o password
        if(isset($_POST["script"]))
            echo 0;
        else{
            //allora torno alla pagina di login
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'login-page.php';
            $_SESSION["loginMessage"] = 1; // controllo dopo sul login cosa stampare a video
            header("Location: https://$host$uri/$extra");
        }

    }

}
catch(PDOException $e)
{
    header("Location: lost.php");
}