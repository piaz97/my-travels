<?php
        #preparare la query con i dati arrivati in post
    #due possibilità, chiamata dal luogo o chiamata dal filtro
    function searchResults(){
        session_start();

        $configs= include('include/config.php');
        #chiamata da luogo
        try {
            $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            if (isset($_POST["maxCost"]) && isset($_POST["maxTappe"]) &&
                isset($_POST["durataOre"]) && isset($_POST["durataGiorni"])) {
                $_SESSION["maxCost"] = $_POST["maxCost"];
                $_SESSION["maxTappe"] = $_POST["maxTappe"];
                $_SESSION["durataOre"] = $_POST["durataOre"];
                $_SESSION["durataGiorni"] = $_POST["durataGiorni"];
            }
            if (!isset($_POST["luogo"]) && !isset($_POST["maxCost"])){
                unset($_SESSION["searchResults"]);
                header("Location: cerca.php");
            }
            #sanare i dati in caso qualcosa non vada bene ed rimadare un errore di invalid data


            #se arrivo qua qualcosa da fare ce l'ho
            $richiesta = "SELECT  DISTINCT
                                  Itinerario.Id as Id, 
                                  Itinerario.Nome as Nome, Itinerario.Durata_ore as Durata_ore,
                                  Itinerario.Durata_giorni as Durata_giorni, Itinerario.Costo as Costo,
                                  Itinerario.Luogo as Luogo, Itinerario.Creatore as Creatore,
                                  Itinerario.Creatore as Autore,
                                  Utente.Reputazione as Reputazione,
                                  COUNT(DISTINCT Tappa.Numero) as Tappe,  
                                  AVG(Valutazione.Voto) as Valutazione ";
            $richiesta2 = "SELECT  DISTINCT Itinerario.Id as Id ";
            $conditions = "
                        FROM Itinerario 
                        LEFT JOIN Tappa on Itinerario.Id = Tappa.Itinerario
                        LEFT JOIN Valutazione on Itinerario.Id = Valutazione.Itinerario
                        LEFT JOIN Utente on Utente.Username = Itinerario.Creatore
                        WHERE Tappa.Numero IS NOT NULL 
                         ";

            #aggiungo il luogo dell'itinerario
            $luogo = "";
            if (isset($_POST["luogo"])){
                $luogo = $_POST["luogo"];
                $_SESSION['luogo'] = $luogo;
            } else if (isset($_SESSION["luogo"])) {
                $luogo = $_SESSION["luogo"];
            } else {
                header("Location: cerca.php");
            }
            $luogo= $luogo.'%';

            $conditions .= " AND Itinerario.Luogo LIKE :luogo";

            if (isset($_SESSION["maxCost"])) {
                #allora vuol dire che tutte e 4 sono settate
                $conditions .= " AND Itinerario.Costo <= :maxCost AND Itinerario.Durata_giorni*24+Itinerario.Durata_ore <= ( :durataGiorni * 24 + :durataOre ) ";
            }
            $conditions .= " GROUP BY Itinerario.Id";
            if(isset($_SESSION["maxTappe"])) {
                $conditions .= " HAVING COUNT(*)<= :maxTappe" ;
            }

            $richiesta2 .= $conditions. ";";
            $richiesta.= $conditions." ORDER BY Valutazione DESC, Itinerario.Id DESC LIMIT :start, :range;";

            ###############
            #setto tutti i parametri che mi servono per gestire gli indici delle pagine nel pagination
            ###############
            $query_pagination = $conn->prepare($richiesta2); #richiesta senza limite
            $query_pagination->bindParam(':luogo',$luogo);
            if(isset($_SESSION["maxTappe"])){
                $query_pagination->bindParam(':maxTappe',$_SESSION["maxTappe"]);
                $query_pagination->bindParam(':maxCost',  $_SESSION["maxCost"]);
                $query_pagination->bindParam(':durataGiorni',$_SESSION["durataGiorni"]);
                $query_pagination->bindParam(':durataOre',$_SESSION["durataOre"]);
            }
            $query_pagination->execute();
            $number_of_results = count($query_pagination->fetchAll(PDO::FETCH_BOTH));

            #se qualche furbo cerca di settare una pagina non sensata allora setta alla prima pagina
            if(!isset($_GET['page']) || $_GET['page']<1) {
                #se la pagina non è settata o possiede un valore non concesso allora la pagina 1 viene settata
                $_GET['page'] = 1;
            }

            #individuazione del range di risultati da ritornate, serve capire da dove partire
            #numero massimo di risultati che posso mostrare
            $RANGE = 8;
            #$_GET['page'] è già sanato sopra
            $start = (($_GET['page'])-1)*$RANGE;
            #il numero delle pagine totale
            $number_of_pages = ceil($number_of_results/$RANGE);
            $_SESSION['maxPages'] = $number_of_pages;
            #devono essere settate le variabili before,prevprev,prev,current,post,postpost,next

            #devo scorrere tutto il vettore delle pages


            $_SESSION['pages']['back'] = $_GET['page']-1;
            $_SESSION['pages']['prevprev'] = $_GET['page']-2;
            $_SESSION['pages']['prev'] = $_GET['page']-1;
            $_SESSION['pages']['current'] = $_GET['page'];
            $_SESSION['pages']['post'] = $_GET['page']+1;
            $_SESSION['pages']['postpost'] = $_GET['page']+2;
            $_SESSION['pages']['next'] = $_GET['page']+1;

            $query = $conn->prepare($richiesta);
            $query->bindParam(':luogo',$luogo);
            if(isset($_SESSION["maxTappe"])){
                $query->bindParam(':maxTappe',$_SESSION["maxTappe"]);
                $query->bindParam(':maxCost',  $_SESSION["maxCost"]);
                $query->bindParam(':durataGiorni',$_SESSION["durataGiorni"]);
                $query->bindParam(':durataOre',$_SESSION["durataOre"]);

            }
            $query->bindParam(':start',$start, PDO::PARAM_INT);
            $query->bindParam(':range',$RANGE, PDO::PARAM_INT);

            $query->execute();
            #salvare i risultati si $_SESSION["searchResults"]
            $_SESSION["searchResults"] = $query->fetchAll(PDO::FETCH_BOTH);

            if(count($_SESSION["searchResults"])==0){

                #pulisco il vettore dei risultati per mostrare il messaggio di errore
                unset($_SESSION["searchResults"]);
                #pulisco il vettore degli indici delle pagine per non mostrare la barra delle pagine
                unset($_SESSION['pages']);
                #pulisco il numero massimo di pagine per il risultato
                unset($_SESSION['maxPages']);
            }
            ################
            #reindirizzare a cerca.php
            #if(!isset($_POST["ajax"]))
             #   header("Location: cerca.php");
        }
        catch(PDOException $e)
        {
            header("Location: lost.php");
        }
    }




