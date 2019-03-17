<?php
$_SESSION["idItinerarioCommento"]= $_GET["idItinerario"];
$content = "SELECT  Commento.Commento as Commento, Utente.Username as Username,
                                Utente.Reputazione as Reputazione
                        FROM Commento LEFT JOIN Utente on Commento.Utente= Utente.Username
                        WHERE Itinerario=:idItinerario 
                        ORDER BY Commento.Id DESC";
$stmt = $conn->prepare($content);
$stmt->bindParam(':idItinerario', $_GET['idItinerario']);
$stmt->execute();
$risultato = $stmt->fetchAll(PDO::FETCH_BOTH);
for ($i = 0; $i <count($risultato); $i++){
    if ($risultato[$i]["Reputazione"]==null){
        $risultato[$i]["Reputazione"]=0;
    }
}
#prelevate tutte le info necessarie

//containerCommenti non deve chiudersi qui ma solo alla fine
echo "
             <div id=\"containerCommenti\">
                 <h1>Commenti</h1>
                 <div id=\"numeroCommentiBox\">
                    <div>
                        <p>".count($risultato)." Commenti</p>
                    </div>
                    <div></div>
                 </div>
         ";

$stmt = $conn->prepare("SELECT Voto FROM Valutazione WHERE Itinerario=:itinerario AND Utente=:utente");
$stmt->bindParam(":utente",$_SESSION["username"]);
$stmt->bindParam(":itinerario",$_SESSION["idItinerarioCommento"]);
$stmt->execute();
$valutazione = $stmt->fetchAll(PDO::FETCH_BOTH);
if(!isset($_SESSION["username"])){
    echo "
                <div id=\"notLoggedCommento\">
                    <h2>Vuoi valutare o commentare questo itinerario? Non c'è problema!</h2>
        
                    <noscript>
                        <p>Hai gia' un account?<a  class=\"LoginLink\" href=\"login-page.php\">Accedi</a></p>
                        <br/><br/>
                        <p>Non hai un account? <a  class=\"LoginLink\" href=\"registrazione-page.php\">Registrati</a></p>
                    </noscript>
                    <div class=\"script\">
                        <a  href=\"javascript:openPopup('logincanvas')\" class=\"LoginLink LoginPonte\">Accedi</a>
                        <p> oppure </p>
                        <a href=\"javascript:openPopup('registrazionecanvas')\" class=\"LoginLink LoginPonte\">Registrati</a>
                    </div>
                </div>
            ";
}
else if(count($valutazione)==0){
    echo "
                <div id=\"valutaItinerario\">
                    <h2>Che voto dai a questo itinerario?</h2>
                    <form action=\"inserisci_valutazione.php\" method=\"post\">
                        <div class=\"PlaceRate\">
                        <fieldset>
                            <legend class='sr-only'>stelle per la valutazione della tappa</legend>
                            <input class='sr-only' type=\"radio\" id=\"star5\" name=\"Evaluation\" value=\"5\" required='required'/>
                            <label for=\"star5\" title=\"text\">5 stars</label>
                            <input class='sr-only' type=\"radio\" id=\"star4\" name=\"Evaluation\" value=\"4\" required='required'/>
                            <label for=\"star4\" title=\"text\">4 stars</label>
                            <input class='sr-only' type=\"radio\" id=\"star3\" name=\"Evaluation\" value=\"3\" required='required'/>
                            <label for=\"star3\" title=\"text\">3 stars</label>
                            <input class='sr-only' type=\"radio\" id=\"star2\" name=\"Evaluation\" value=\"2\" required='required'/>
                            <label for=\"star2\" title=\"text\">2 stars</label>
                            <input class='sr-only' type=\"radio\" id=\"star1\" name=\"Evaluation\" value=\"1\" required='required'/>
                            <label for=\"star1\" title=\"text\">1 star</label>
                        </fieldset>
                        </div>
                        <button type=\"submit\" class=\"materialButton _30\">Vota!</button>
                    </form>
                </div>
                ";

}
else{
    echo "
                <div id='votoPersonaleItinerario'>
                    <img src=\"profilePictures/".$_SESSION['username'].".jpg?rd=".filemtime("profilePictures/".$_SESSION['username'].".jpg")."\" alt=\"la tua immagine profilo\"/>
                    <div id='votoPersonaleItinerarioContent'>
                        <p>La tua valutazione</p>
                        <div>".stampaStelle($valutazione[0]["Voto"])."</div>
                    </div>
                </div>
                
                ";
}

if(isset($_SESSION["username"])){
    echo "
                <div id=\"creaCommento\">
                <h2>Che commento vuoi lasciare su questo itinerario?</h2>
                    <img src=\"profilePictures/".$_SESSION['username'].".jpg?rd=".filemtime("profilePictures/".$_SESSION['username'].".jpg")."\" alt=\"la tua immagine profilo\"/>
                    <form action=\"inserisci_commento.php\" method=\"post\">
                         <label class='sr-only'>Inserisci un commento</label>
                         <textarea rows=\"4\" cols=\"50\" name=\"commento\" maxlength=\"500\" placeholder=\"Inserisci un commento..\" required='required'></textarea>
                         <button type=\"submit\" class=\"materialButton _30\">Commenta</button>
                    </form>
                    ";
    if(isset($_SESSION['error-comment'])) {
        echo"
                    <div id = \"error-comment\" class=\"message danger shown\" >
                        <em > Errore:</em > Il commento supera i 500 caratteri oppure è vuoto
                    </div>
                    ";
    }

    //chiudo creaCommento
    echo "</div>";
}

echo "
                 <div class=\"commentoContainer\">
              ";
#devo stampare tutti i commenti individuati
for ($i = 0; $i <count($risultato); $i++){
    echo "
                 <div class=\"commento\">
                    <img src=\"profilePictures/".$risultato[$i]['Username'].".jpg?rd=".filemtime("profilePictures/".$_SESSION['username'].".jpg")."\" alt=\"immagine profilo 
                    utente".$risultato[$i]['username']." \"/>
                    
                    <div class=\"rightCommento\" >
                        <div class=\"topCommento\">
                            <h1>".$risultato[$i]['Username']."</h1>
                            <h2> Reputazione: ".$risultato[$i]['Reputazione']."</h2>
                        </div>
                        <div class=\"commentoContent\">
                            ".$risultato[$i]['Commento']."
                        </div>
                    </div>
                </div>
                ";
}
#chiudo  commentoContainer e containerCommenti
echo " 
                 </div> 
             </div>";
