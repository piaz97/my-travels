<?php
$configs= include('include/config.php');
include_once('funzioni.php');
try {
    session_start();
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (    !empty($_POST["FirstName"]) ||
            !empty($_POST["LastName"]) ||
            !empty($_POST["DateBirth"]) ||
            !empty($_POST["Email"]) ||
            !empty($_POST["Password"] ) ||
            !empty($_POST["Gender"])) {
        
        $command = "UPDATE Utente SET ";

        $flag_modifica = true;
        #nessun controllo sul nome
        if (!empty($_POST["FirstName"])) {
            $command .= "Nome = :name,";
            $_SESSION["nome"] = $_POST["FirstName"];
        }
        #nessun controllo sul cognome
        if (!empty($_POST["LastName"])) {
            $command .= "Cognome = :cognome,";
            $_SESSION["cognome"] = $_POST["LastName"];
        }
        #check ed errore settati dalla funzione checkdate
        if (!empty($_POST["DateBirth"])) {
            if(mycheckdate($_POST["DateBirth"], $_SESSION["modifyError"])) {
                $command .= "Data_nascita = :date,";
                $_SESSION["dataNascita"] = $_POST["DateBirth"];
            }else{
                $flag_modifica = false;
            }
        }

        #check per controllare che sia un mail valida e non sia già presente nel db
        if (!empty($_POST["Email"]) ) {
            if(!checkMail($_POST["Email"], $conn)) {
                $command .= "Mail = :mail,";
                $_SESSION["mail"] = $_POST["Email"];
            }
            else{
                $_SESSION["modifyError"] = "formato email non valido o email già presente";
                $flag_modifica = false;
            }
        }
        #controllo che la password sia lunga almeno 8 caratteri
        if (!empty($_POST["Password"])) {
            if(strlen($_POST["Password"])>7)
                $command .= "Password = :password,";
            else{
                $_SESSION["modifyError"] = "la password deve essere lunga almeno 8 caratteri";
                $flag_modifica = false;
            }
        }
        if (!empty($_POST["Gender"])) {
            if($_POST["Gender"]=="Maschio" || $_POST["Gender"] =="Femmina" || $_POST["Gender"] =="Altro") {
                $command .= "Sesso = :sesso,";
                $_SESSION["sesso"] = $_POST["Gender"];
            }
            else{
                $_SESSION["modifyError"] = "gender non valido";
                $flag_modifica = false;
            }
        }

        #se la flag_modifica è settata a false allora vuol dire che è presente un errore, non
        #viene effettuata la modifica
        if($flag_modifica == true) {
            //REMOVE LAST CHAR FROM COMMAND
            $command = substr($command, 0, -1);

            $command = $command . " WHERE Username = :username;";


            $stmt = $conn->prepare("$command");

            if (!empty($_POST["FirstName"]))
                $stmt->bindParam(':name', $_POST["FirstName"]);
            if (!empty($_POST["LastName"]))
                $stmt->bindParam(':cognome', $_POST["LastName"]);
            if (!empty($_POST["DateBirth"]))
                $stmt->bindParam(':date', $_POST["DateBirth"]);
            if (!empty($_POST["Email"]))
                $stmt->bindParam(':mail', $_POST["Email"]);
            if (!empty($_POST["Password"]))
                $stmt->bindParam(':password', password_hash($_POST["Password"], PASSWORD_DEFAULT));
            if (!empty($_POST["Gender"]))
                $stmt->bindParam(':sesso', $_POST["Gender"]);

            $stmt->bindParam(':username', $_SESSION["username"]);
            $stmt->execute();

            unset($_SESSION["modifyError"]);
            $_SESSION['successModification'] = 1;
        }

    }
    else{
        $_SESSION["modifyError"] = "non hai compilato alcun campo";
    }
    #in ogni caso dopo aver effettuato la modifica o aver settato l'errore, viene ricaricata l'area personale
    header("Location: area_personale.php");


}
catch(PDOException $e)
{
    header("Location: lost.php");
}
