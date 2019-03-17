<?php
    include_once('funzioni.php');

    $configs= include('include/config.php');
    //$conn contains the connection obj
    try {
        $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST["checkMail"]) && isset($_POST["mail"])) {
            echo checkMail($_POST["mail"], $conn);
            exit();
        }
        else if (isset($_POST["checkUser"]) && isset($_POST["username"])) {
            echo checkUsername($_POST["username"], $conn);
            exit();
        }

        //controlli per tentativo di registrazione
        else if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["passwordRepeat"]) ||
            !isset($_POST["mail"]) || empty($_POST["username"]) ||  empty($_POST["mail"]) ||
            empty($_POST["password"]) || empty($_POST["passwordRepeat"])){
                //almeno uno dei campi non è settato
                $_SESSION["registrationError"] = "Tutti i campi devono essere compilati";
                checkAjax($_SESSION["registrationError"] );
        }

        /*** tutti i campi sono settati ***/
        else if(strlen($_POST["username"])<4){
            $_SESSION["registrationError"] = "Lo username deve essere lungo almeno 4 caratteri";
            checkAjax($_SESSION["registrationError"] );
        }
        else if(preg_match('/\s/',$_POST["username"]) ){
            $_SESSION["registrationError"] = "Lo username non può contenere spazi";
            checkAjax($_SESSION["registrationError"] );
        }

        else if(checkUsername($_POST["username"], $conn)) {
            //username già occupato
            $_SESSION["registrationError"] = "Username già presente, scegliene un altro";
            checkAjax($_SESSION["registrationError"] );

        }
        //allora lo username era libero
        else if(checkMail($_POST["mail"], $conn)){
            //mail già occupato
            $_SESSION["registrationError"] = "Email già presente, scegliene un'altra";
            checkAjax($_SESSION["registrationError"]);
        }
        else if(strlen($_POST["password"])<8){
            $_SESSION["registrationError"] = "La password deve essere lunga almeno 8 caratteri";
            checkAjax($_SESSION["registrationError"]);
        }
        else if($_POST["password"] != $_POST["passwordRepeat"]){
            $_SESSION["registrationError"] = "Le due password non coincidono";
            checkAjax($_SESSION["registrationError"]);
        }
        //controllo sintassi mail
        else if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
            $_SESSION["registrationError"] = "Inserire una mail valida";
            checkAjax($_SESSION["registrationError"]);
        }
        else {
            //dati validi, script attivo "registrazione oppure pagina statica"
            $stmt = $conn->prepare("INSERT INTO Utente (Username, Password, Mail, Reputazione)
                VALUES (:username, :password, :mail, 0)");
            $stmt->bindParam(':username', $_POST["username"]);
            $stmt->bindParam(':password', password_hash($_POST["password"], PASSWORD_DEFAULT));
            $stmt->bindParam(':mail', $_POST["mail"]);
            $stmt->execute();

            $file = 'img/backpack.png';
            $newfile = 'profilePictures/' . $_POST['username'] . ".jpg";
            copy($file, $newfile);
            $_SESSION["registrationSuccess"] = 1; // controllo dopo sul login cosa stampare a video
            checkAjax(1); //1 dice che la registrazione è andata a buon fine
            //far sparire eventuali errori di login effettuati in precedenza
            unset($_SESSION["registrationError"]);
        }
        unset($_SESSION["loginMessage"]);
    }
    catch(PDOException $e)
    {
        header("Location: lost.php");
    }
