<div class="LuogoContainer">
    <div class="LuogoTitoloContainer">
        <h1 id="LuogoTitolo">Aggiungi una tappa al tuo viaggio!</h1>
        <span id="LuogoClose"><a href="miei_viaggi.php">x</a></span>
    </div>
    <div class="PlaceCenterContainer">
        <div class="PlaceFormContainer">
            <form id="PlaceForm" action="aggiungi-tappa.php" method="post" enctype="multipart/form-data">
                <div class="PlaceInputBox">
                    <input class="PlaceInput" type="text" id="PlaceName" placeholder="aggiungi un nome a questo luogo!" name="Name" maxlength="64" required>
                </div>
                <div class="PlaceTextArea">
                    <textarea id="PlaceDesc" placeholder="descrizione del luogo" name="Description" cols="20" rows="5" maxlength="512" required></textarea>
                </div>
                <div id="PlaceRatingBox">
                    <p>Che voto dai a questo luogo?</p>
                    <div class="PlaceRate">
                        <input type="radio" id="star5" name="Evaluation" value="5" required/>
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="Evaluation" value="4" required/>
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="Evaluation" value="3" required/>
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="Evaluation" value="2" required/>
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="Evaluation" value="1" required/>
                        <label for="star1" title="text">1 star</label>
                    </div>
                </div>
                <div class="PlaceFileBox">
                    <p id="FileName">Aggiungi una foto del posto!</p>
                    <!--<input class="PlaceInput" type="file" id="PlaceImg"  name="Image" accept="image/*" required onchange="getFileName('PlaceImg','FileName')">-->
                    <input class="sr-only" type="file" id="PlaceImg"  name="Image" accept="image/*" onchange="loadFile(event)" required>
                    <script>
                        var loadFile = function(event) {
                            //document.getElementById("anteprimaFoto").style.display = "block";
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>
                    <img id="output"/>
                    <label class ="materialButton flexButton _50" for="PlaceImg">Seleziona</label>
                    <?php session_start();
                    if ($_SESSION["errorProfilePicture_1"] == true){
                        echo ("<p class='danger'>Formato non valido. Carica una foto in JPG o PNG.</p>");
                        $_SESSION['errorStopPicture_1'] = false;
                    }
                    else if ($_SESSION["errorProfilePicture_2"] == true){
                        echo ("<p class='danger'>Immagine non selezionata. Carica una foto in JPG o PNG.</p>");
                        $_SESSION['errorStopPicture_2'] = false;
                    }
                    ?>
                </div>
                <hr id="PlaceFormSeparator">
                <div>
                    <input type="hidden" id="PlaceAddress"  name="Address">
                    <input type="hidden" id="PlaceLatitude" name="Latitude">
                    <input type="hidden" id="PlaceLongitude" name="Longitude">
                    <?php session_start();
                    if ($_SESSION["errorPlace"] == true){
                        echo ("<p class='danger'>Luogo non inserito, posiziona un marker sulla mappa o sceglilo dalla barra di ricerca</p>");
                        $_SESSION["errorPlace"] = false;
                    }
                    ?>
                </div>
                <div class="PlaceButtonContainer">
                    <button type="submit" class="materialButton _50">Aggiungi Tappa</button>
                </div>
            </form>
        </div>
    </div>

    <div class="MapContainer">
        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
        <div id="map"></div>
    </div>
</div>