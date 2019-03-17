<?php
function stampaStelle($numero){
    $result="";
    for($star=1; $numero!=NULL && $star<=$numero && $star<=5; $star++) {
        $result.="<img src=\"img/stella.svg\" alt=\"stella ".$star."\"/>";
    }
    if ($result==""){
        $result = "Nessuna valutazione disponibile";
    }
    return $result;
}
function getItinerarioById($id){
    $configs= include('include/config.php');
    try {
        $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $richiesta = "SELECT * FROM Itinerario WHERE Itinerario.Id =:Id";
        $query = $conn->prepare($richiesta);
        $query->bindParam(':Id',$id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_BOTH);

        if(count($result)==0){
            return null;
        }
        else{
            return $result[0];
        }
    }
    catch(PDOException $e) {
        return null;
    }
}

function printItinerario($itinerario, $cerca){
    if ($itinerario["Reputazione"]==null){
        $itinerario["Reputazione"]=0;
    }
    if($cerca == 1){
        $form = "<form action=\"visualizza_itinerario_cerca.php\" method=\"get\">
                         <fieldset>
                            <legend class='sr-only'>tasto per la visualizzazione dell'itinerario</legend>
                            <input type=\"hidden\" name=\"idItinerario\" value='".$itinerario["Id"]."'/>
                         </fieldset>
                         <button type=\"submit\" class=\"materialButton _50\">VISUALIZZA</button>
                 </form>
            ";
        $autore = "  <div class=\"autoreItinerario\">
                        <img src=\"profilePictures/".$itinerario['Autore'].".jpg?rd=".filemtime("profilePictures/".$itinerario['Autore'].".jpg")."\" alt=\"immagine profilo
                            utente\"/>
                        <div class=\"autoreInfo\">
                            <h1>".$itinerario["Autore"]."</h1>
                            <h2>Reputazione ".$itinerario["Reputazione"]."</h2>
                        </div>
                    </div>
                    ";
    }
    else if ($cerca == 2){
        $form = "<form action=\"eliminazioneItinerario.php\" method=\"post\">
                    <input type=\"hidden\" id=\"itinerarioId\" name=\"itinerarioId\" value=\"".$itinerario["Id"]."\"/>
                    <button type=\"submit\" class=\"materialButton dangerButton _50\">ELIMINA</button>
                 </form>
                   ";
        $autore = "";
    }
    else {

        $form = "
                <form action=\"confermaEliminazioneItinerario.php\" method=\"post\">
                    <input type=\"hidden\" name=\"itinerarioId\" value=\"".$itinerario["Id"]."\"/>
                    <button type=\"submit\" class=\"materialButton dangerButton _50\">ELIMINA</button>
                </form>
                <form action=\"visualizza_itinerario.php\" method=\"get\">
                    <fieldset>
                        <legend class='sr-only'>tasto per la visualizzazione dell'itinerario</legend>
                        <input type=\"hidden\" name=\"idItinerario\" value='".$itinerario["Id"]."'/>
                     </fieldset>
                     <button type='submit' class=\"materialButton _50\">VISUALIZZA</button>
                 </form>
                ";
        $autore = " ";
    }

    #aggiungiamo form per indirizzare alle pagine giuste a seconda di quale pagina stia chiamando la funzione
    #stampiamo l'autore solo in ricerca
    return "
                 <div class=\"travelProfileContainer\">
                <div class=\"leftTravelProfileBox\">
                    <h1>".$itinerario["Nome"]."</h1>
                    <img src=\"tripPictures/".$itinerario['Id'].".jpg\" alt=\"foto dell'itinerario\"/>
                     <h1>".$itinerario["Luogo"]."</h1>
                </div>
                
                <div class=\"rightTravelProfileBox\">
                    <div class=\"travelFeat\">
                        <img src=\"img/clock.svg\" alt=\"Durata\"/>
                        <p>".$itinerario["Durata_giorni"]." giorni e ".$itinerario["Durata_ore"]." ore</p>
                    </div>
                    <div class=\"travelFeat\">
                        <img src=\"img/credit-card.svg\" alt=\"costo\"/>
                        <p>".$itinerario["Costo"]."€</p>
                    </div>
                    <div class=\"travelFeat\">
                        <img src=\"img/placeholder.svg\" alt=\"numero di tappe\"/>
                        <p>".$itinerario["Tappe"]." tappe</p>
                    </div>
                    <div class=\"travelFeat\">
                        <img src=\"img/like.svg\" alt=\"valutazione\"/>
                        <p>".stampaStelle($itinerario["Valutazione"])."</p>
                    </div>
                   
                    ".$autore.$form."
                    
                      
                </div>
                
            </div>
                
                ";
}

function stampaItinerariRicerca() {
    $ris="";
    if (!isset($_SESSION["searchResults"]) || count($_SESSION["searchResults"]) == 0) {
        $ris = " <div id=\"notLoggedContainer\">
            <p><em>Nulla da mostrare</em>, o non hai ancora cercato nulla, oppure
                la tua ricerca non ha prodotto alcun risultato
            </p>
            <img src=\"img/sad.svg\"  alt=\"Nessun risultato\" class=\"emoticon\"'/>
        </div>";

    } else {
        $itinerari = $_SESSION["searchResults"];

        foreach ($itinerari as $itinerario){
            $ris.= printItinerario($itinerario,1);
        }

    }
    return $ris;

}

function stampaItinerariProfilo() {
    if (!isset($_SESSION["profileTravelsResults"]) || count($_SESSION["profileTravelsResults"]) == 0) {
        echo "
                <div id=\"notLoggedContainer\">
                    <p><em>Oh no!</em> Non hai ancora nessun viaggio, perchè non cominci a viaggiare anche tu?
                     <a href='viaggio.php'>Inizia subito!</a>
                    </p>
                </div>";
    } else {
        $itinerari = $_SESSION["profileTravelsResults"];
        foreach ($itinerari as $itinerario){
            echo printItinerario($itinerario,0);
        }
    }
}

function trovaItinerariProfilo() {
    $configs= include('include/config.php');
    #preparare la query con i dati arrivati in post
    #due possibilità, chiamata dal luogo o chiamata dal filtro

    #chiamata da luogo
    try {
        $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $richiesta = "SELECT DISTINCT Itinerario.Nome as Nome, 
                                      Itinerario.Id as Id, 
                                      Itinerario.Durata_ore as Durata_ore, 
                                      Itinerario.Durata_giorni as Durata_giorni, 
                                      Itinerario.Costo as Costo, 
                                      Itinerario.Luogo as Luogo,
                                      Itinerario.Creatore as Creatore, 
                                      COUNT(DISTINCT Tappa.Numero) as Tappe, 
                                      AVG(Valutazione.Voto) as Valutazione 
                                      FROM Itinerario 
                                      LEFT JOIN Tappa on Itinerario.Id = Tappa.Itinerario 
                                      LEFT JOIN Valutazione on Itinerario.Id = Valutazione.Itinerario 
                                      WHERE Creatore=:username 
                                      GROUP BY Itinerario.Id
                        ";

        $query = $conn->prepare($richiesta);
        $query->bindParam(':username',$_SESSION['username']);
        $query->execute();


        $_SESSION["profileTravelsResults"] = $query->fetchAll(PDO::FETCH_BOTH);

        if(count($_SESSION["profileTravelsResults"])==0){
            unset($_SESSION["profileTravelsResults"]);
        }
    }
    catch(PDOException $e) {
        echo 2;
    }

}

function getTappaByIdAndNum($id, $num){
    $configs= include('include/config.php');
    #preparare la query con i dati arrivati in post
    #due possibilità, chiamata dal luogo o chiamata dal filtro

    #chiamata da luogo
    try {
        $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $conn->prepare("SELECT Itinerario, Numero, Nome, Commento, Indirizzo, Voto FROM Tappa 
        WHERE Tappa.Itinerario='".$id."'AND Tappa.Numero = ".$num.";");
        $query->execute();
        $risultato = $query->fetchAll(PDO::FETCH_BOTH);

        if (count($risultato) == 0) {
            return null;
        } else {
            return $risultato[0];
        }

    }
    catch(PDOException $e) {
        return null;
    }
}


function stampaTappa($id, $elimina) {
    $configs= include('include/config.php');
    #preparare la query con i dati arrivati in post
    #due possibilità, chiamata dal luogo o chiamata dal filtro

    #chiamata da luogo
    try {
        $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $conn->prepare("SELECT Itinerario, Numero, Nome, Commento, Indirizzo, Voto FROM Tappa 
        WHERE Itinerario='".$id."' ORDER BY Numero");
        $query->execute();
        $risultato = $query->fetchAll(PDO::FETCH_BOTH);

        if (count($risultato) == 0) {
            echo "<p><em>Nulla da mostrare</em>, non ci sono tappe</p>";
        } else {
            $numtappa=0;
            foreach ($risultato as $tappa){
                $numtappa=$numtappa+1;
                echo printTappa($tappa,$numtappa, $elimina);
            }
        }

    }
    catch(PDOException $e) {
        header("Location: lost.php");
    }

}





function printTappa($tappa,$numtappa, $elimina){
    $ris = "
           <div class=\"itinerarioTappaContainer\">
                <div class=\"boxNumeroTappa\">&num;".$numtappa."</div>
                <div class=\"leftTappaBox\">
                    <h1>".$tappa["Nome"]."</h1>
                    <img alt=\"immagine itinerario\" src=\"travelStopPictures/".$tappa["Itinerario"]."_".$tappa["Numero"].".jpg"."\"/>
                </div>
                
                <div class=\"rightTappaBox\">
                    <div class=\"tappaFeat\">
                        <img src=\"img/placeholder.svg\" alt=\"indirizzo\" />
                        <p>".$tappa["Indirizzo"]."</p>
                    </div>
                    <div class=\"tappaFeat\">
                        <img src=\"img/like.svg\" alt=\"valutazione\"/>
                        <p>".stampaStelle($tappa["Voto"])."</p>
                    </div>
                    <div class=\"tappaFeat\">
                        <img src=\"img/conversation.svg\" alt=\"descrizione della tappa\"/>
                            <p>".$tappa["Commento"]."</p>
                    </div>
                </div>
                

                ";
    if($elimina == 1){
        $ris.= "<form action=\"confermaEliminazioneTappa.php\" method=\"post\">
                    <input type=\"hidden\"  name=\"itinerarioId\" value=\"".$tappa["Itinerario"]."\"/>
                    <input type=\"hidden\" name=\"numeroTappa\" value=\"".$tappa["Numero"]."\"/>
                    <button type=\"submit\" class=\"materialButton dangerButton _50\">ELIMINA</button>
                </form>";
    }
    if($elimina == 2){
        $ris.= "<form action=\"eliminazioneTappa.php\" method=\"post\">
                    <input type=\"hidden\" name=\"itinerarioId\" value=\"".$tappa["Itinerario"]."\"/>
                    <input type=\"hidden\" name=\"numeroTappa\" value=\"".$tappa["Numero"]."\"/>
                    <button type=\"submit\" class=\"materialButton dangerButton _50\">ELIMINA</button>
                </form>";
    }
    $ris .= "</div>";

    return $ris;
}

function stampaCoupon($utente) {
    $configs= include('include/config.php');
    #preparare la query con i dati arrivati in post
    #due possibilità, chiamata dal luogo o chiamata dal filtro

    #chiamata da luogo
    try {
        $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $conn->prepare("SELECT Coupon.Id as Id, Coupon.Nome as Nome, Coupon.Descrizione as Descrizione,
                                Coupon.Importo as Importo, Coupon.Soglia as Soglia, Riscatto.Utente as Utente, Riscatto.Codice as Codice
                                FROM Coupon JOIN Utente LEFT JOIN Riscatto on Riscatto.Utente = Utente.Username and Riscatto.Coupon = Coupon.Id WHERE Utente.Username=:username ORDER BY Coupon.Soglia");
        $query->bindParam(':username',$utente);
        $query->execute();
        $risultato = $query->fetchAll(PDO::FETCH_BOTH);

        $query2 = $conn->prepare("SELECT Reputazione FROM Utente WHERE Username=:username");
        $query2->bindParam(':username',$utente);
        $query2->execute();
        $temp=$query2->fetchAll(PDO::FETCH_BOTH);
        $reputazione=$temp[0]["Reputazione"];


        if (count($risultato) == 0) {
            echo "<p><em>Nulla da mostrare</em>, non ci sono coupon</p>";
        } else {
            foreach ($risultato as $coupon){
                echo printCoupon($coupon,$reputazione);
            }
        }

    }
    catch(PDOException $e) {
        header("Location: lost.php");
    }

}

function printCoupon($coupon,$reputazione) {

    if($coupon["Codice"]) {
        $contenuto="<p class='codiceCoupon'>".$coupon["Codice"]."</p>";
    }
    elseif($reputazione>=$coupon["Soglia"]) {

       $contenuto="<form action='riscattacoupon.php' method='post'>
                        <label for=\"couponId\" class='sr-only'>tasto per riscattare il coupon</label>
                        <input type='hidden' value='".$coupon["Id"]."' name='couponid' id='couponId'/>
                        <button type='submit' class='materialButton _70'>Riscatta</button>
                   </form>
                   ";
    }
    else{
        $contenuto="<button type='button' class='materialButton disabledButton _70'>Riscatta</button>";
    }
    return "        
        <div class=\"itinerarioTappaContainer\">
                <div class=\"leftTappaBox\">
                    <h1>".$coupon["Nome"]."</h1>
                    <img alt=\"immagine cuopon\" src=\"img/".$coupon["Nome"].".jpg\"/>
                </div>
                <div class=\"rightTappaBox\">
                    <div class=\"tappaFeat\">
                        <img src=\"img/credit-card.svg\" alt=\"valore in euro del coupon\"/>
                        <p>Valore del coupon in euro: <br/> ".$coupon["Importo"]."</p>
                    </div>
                    <div class=\"tappaFeat\">
                        <img src=\"img/placeholder.svg\" alt=\"quanto ti manca per riscattare il coupon\"/>
                        <p> Una volta raggiunto il valore di destra potrai riscattare il coupon: <br/> ".$reputazione."/".$coupon["Soglia"]."</p>
                    </div>
                    <div class=\"tappaFeat\">
                        <img src=\"img/conversation.svg\" alt=\"descrizione della tappa\"/>
                        <div class=\"tappaDescrizione\">
                            <p>".$coupon["Descrizione"]."</p>
                        </div>
                    </div>
                    <div class='center _100'>
                        ".$contenuto."
                    </div>
                </div>
        </div>
    ";
}


###########################################
# FUNZIONI PER I CHECK SU ALCUNI CAMPI DATO
###########################################
function checkUsername($user, PDO $connection){
    $check = $connection->prepare(
        "SELECT * FROM Utente WHERE Username=:username");
    $check->bindParam(':username', $user);
    $ris = $check->fetchAll();
    return count($ris)>0;
}

function checkMail($mail, PDO $connection){
    $check = $connection->prepare(
        "SELECT * FROM Utente WHERE Mail=:mail");
    $check->execute(array(':mail'=>$mail));
    $ris = $check->fetchAll();
    return count($ris);
}
//se ajax è attivo torna il messaggio, altrimenti ricarica la pagina di registrazione
function checkAjax($message){
    if (isset($_POST["registration"])) {
        echo $message;
        exit();
    } else {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'registrazione-page.php';
        header("Location: https://$host$uri/$extra");
    }
}

#funzione che testa se una data inserita è valida
function mycheckdate($date, &$error){
    try {
        list($y, $m, $d) = explode("-", $date);
        if (is_numeric($y) && is_numeric($m) && is_numeric($d) && checkdate($m, $d, $y)) {
            #se ha meno di 14 anni
            $date1 = date_create_from_format("Y-m-d", $date);
            $current_data = date_create_from_format("Y-m-d",date("Y-m-d"));
            $diff=date_diff($date1,$current_data);
            if ($current_data<$date1) {
                $error = "La nostra community è aperta a tantissimi tipi di viaggiatori, 
            non ancora ai viaggiatori nel tempo";
                return false;
            }
            else if ($diff->format("%Y") < 10) {
                $error = "Sembri troppo giovane per utilizzare il nostro sito, chiedi aiuto ad un genitore";
                return false;
            } else if ($diff->format("%Y") > 120) {
                $error = "Saresti morto con quegl'anni, controlla la data di nascita";
                return false;
            }
            else {
                return true;
            }
        } else {
            $error = "Non è stato inserito un formato data corretto";
            return false;
        }
    }
    catch (Exception $e) {
        $error = "Problema nella modifica della data, provare più tardi";
        return false;
    }
}


