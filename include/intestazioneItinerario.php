<div id="rightTopItinerario">
    <div id="topShowItinerario">
        <?php
            $stmt = $conn->prepare("SELECT Nome,AVG(Valutazione.Voto) as Voto, COUNT(Valutazione.Voto) 
                                                as Numero FROM Itinerario 
                                                LEFT JOIN Valutazione on Itinerario.Id = Valutazione.Itinerario 
                                                WHERE Itinerario.Id =:idItinerario GROUP BY Itinerario.Id ");
            $stmt->bindParam('idItinerario', $_GET['idItinerario']);
            $stmt->execute();
            $risultato = $stmt->fetchAll(PDO::FETCH_BOTH);

            echo "<h1>".$risultato[0]["Nome"]."</h1>";
            include_once ("funzioni.php");
            echo "<div id='votoItinerario'>".stampaStelle($risultato[0]["Voto"])."<p>";
            if ($risultato[0]["Voto"]!=null){
                if ($risultato[0]["Numero"]==1)
                    echo $risultato[0]["Numero"]." valutazione</p>";
                else
                    echo $risultato[0]["Numero"]." valutazioni</p>";
            }
            echo "</div>";

        ?>
    </div>
    <div id="sceltaItinerario">
        <ul>
            <li id="sceltaItinerarioList" class="sceltaItinerario vistaSelezionata">
                <a href='#' onclick='openlist()'>
                    <img alt="visualizza tappe in lista" src="img/list.svg"/>
                    Lista
                </a>
            </li>
            <?php
            $stmt = $conn->prepare("SELECT COUNT(Numero) as Numero FROM Tappa
                                              WHERE Itinerario =:idItinerario GROUP BY Itinerario ");
            $stmt->bindParam('idItinerario', $_GET['idItinerario']);
            $stmt->execute();
            $risultato = $stmt->fetchAll(PDO::FETCH_BOTH);

            if (count($risultato)!=0)
                echo "
                    <li id=\"sceltaItinerarioMap\" class=\"sceltaItinerario\">
                        <a href='#' onclick='openmap()'>
                            <img alt='visualizza le tappe nella mappa' src=\"img/map.svg\"/>
                            Mappa
                        </a>
                    </li>
            ";
            ?>
        </ul>
    </div>
</div>