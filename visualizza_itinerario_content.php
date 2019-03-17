<div id="profileContainer">
    <?php
        include_once("include/profileNavbar.php");
    ?>
    <div id="rightItinerario">
        <nav id="breadcrumb" aria-label="Breadcrumbs">
            <span>Ti trovi in:&nbsp;</span>
            <ol>
                <li><a href="area_personale.php">Area personale</a></li>
                <li><a href="miei_viaggi.php">I miei viaggi</a></li>
                <li>Visualizza itinerario <?php echo $_POST['itinerarioId'];?></li>
            </ol>
        </nav>
        <?php
            include_once("include/intestazioneItinerario.php");
        ?>

        <div id="rightTappa">
            <div id="aggiungiTappa">
                <div id="aggiungiTappaContent">
                    <a href="tappa.php">
                        <p>Aggiungi una tappa</p>
                        <img src="img/plus.svg" alt="aggiungi una nuova tappa"/>
                    </a>
                </div>

            </div>
            <?php
                include_once ("funzioni.php");
                stampaTappa($_GET['idItinerario'], 1);
            ?>
            <!--
                PARTE DEI COMMENTI
            -->
            <?php
                include_once ("include/sezioniCommenti.php");
            ?>
        </div>

        <!--PARTE MAPPA---------->
        <div id="itinerarioMap"></div>
        <?php

        $configs= include('include/config.php');
        #preparare la query con i dati arrivati in post
        #due possibilità, chiamata dal luogo o chiamata dal filtro

        #chiamata da luogo
        try {
            $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("SELECT Numero, Itinerario, Commento, Nome, Latitudine, Longitudine FROM Tappa WHERE Itinerario=:itinerario");
            $query->bindParam(':itinerario',$_SESSION['iditinerario']);
            $query->execute();
            $posizioni = $query->fetchAll(PDO::FETCH_BOTH);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </div>
</div>





<script type="text/javascript">
    var posizioni;
    function getpositions() {
    posizioni = <?php echo json_encode($posizioni, JSON_PRETTY_PRINT) ?>;
    }

    function openmap() {
        document.getElementById("rightTappa").style.display="none";
        document.getElementById("itinerarioMap").style.display="inline-block";
        document.getElementById("sceltaItinerarioMap").setAttribute("class", "sceltaItinerario vistaSelezionata");
        document.getElementById("sceltaItinerarioList").setAttribute("class", "sceltaItinerario");
    }

    function openlist() {
        document.getElementById("itinerarioMap").style.display="none";
        document.getElementById("rightTappa").style.display="inline-flex";
        document.getElementById("sceltaItinerarioMap").setAttribute("class", "sceltaItinerario");
        document.getElementById("sceltaItinerarioList").setAttribute("class", "sceltaItinerario  vistaSelezionata");
    }

    function initMap() {
        getpositions();
        map = new google.maps.Map(document.getElementById('itinerarioMap'), {
            center: {lat: parseFloat(posizioni[0]["Latitudine"]), lng: parseFloat(posizioni[0]["Longitudine"])},
            zoom: 13,
            disableDefaultUI: true,
            gestureHandling: 'greedy'
        });
        var infowindow = new google.maps.InfoWindow;
        var marker, i;
        for (i = 0; i < posizioni.length; i++) {
            //set markers
            marker = new google.maps.Marker({
                position: {lat: parseFloat(posizioni[i]["Latitudine"]), lng: parseFloat(posizioni[i]["Longitudine"])},
                label: (i + 1).toString(),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent('<div id=\'tappaInfoW\'>' + '<h1>' + posizioni[i]["Nome"] + '</h1>' + '</br>' + '<p>' +posizioni[i]["Commento"]+ '</p>'+ '</br>'+
                        '<img src=\'travelStopPictures\\'+posizioni[i]["Itinerario"]+'_'+posizioni[i]["Numero"]+'.jpg\' >'+'</div>');
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAKF6I6FaWFdnsDv6Rxxu6nxCQZNrTWaw&libraries=places&callback=initMap" async="async" defer="defer"></script>