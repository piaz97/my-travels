<div id="ViaggioFormContainer">
    <div id="ViaggioFormBox">
        <div id="ViaggioFormTitle">
            <p>Compila i campi per aggiungere un nuovo viaggio</p>
        </div>
        <form action="aggiungi-viaggio.php" method="post" enctype="multipart/form-data">
            <div class="ViaggioInputBox">
                <img src="img/tripname.svg" alt="" class="ViaggioInputIcon"/>
                <input class="ViaggioInput" type="text" id="ViaggioName" placeholder="Dai un nome al tuo viaggio!" name="Name" maxlength="64" required="required"/>
            </div>
            <div class="ViaggioInputBox">
                <img src="img/cityhall.svg" alt="" class="ViaggioInputIcon"/>
                <input class="ViaggioInput" type="text" id="ViaggioPlace" placeholder="Inserisci il comune" name="Place" maxlength="64" required="required"/>
            </div>
            <div id="ViaggioTimeDesc"><p>Inserisci la durata del tuo viaggio</p></div>
            <div class="ViaggioTimeBox">
                <div class="ViaggioDayHoursBox">
                    <div class="ViaggioLabelBox">
                        <img src="img/days.svg" alt="" class="ViaggioInputIcon"/>
                        <label for="ViaggioGiorni">Giorni</label>
                    </div>
                    <input class="ViaggioInput" type="number" min="0" max="15" placeholder="0-15" id="ViaggioGiorni" name="Days" required="required"/>
                </div>
                <div class="ViaggioDayHoursBox">
                    <div class="ViaggioLabelBox">
                        <img src="img/clock.svg" alt="" class="ViaggioInputIcon"/>
                        <label for="ViaggioOre">Ore</label>
                    </div>
                    <input class="ViaggioInput" type="number" min="0" max="24" placeholder="0-24" id="ViaggioOre"  name="Hours" required="required"/>
                </div>
            </div>
            <div id="ViaggioCostBox">
                <div class="ViaggioLabelBox">
                    <img src="img/money.svg" alt="" class="ViaggioInputIcon"/>
                    <label for="ViaggioCosto">Quanto hai pagato?</label>
                </div>
                <input type="number" id="ViaggioCosto" placeholder="0-5000" min="0" max="5000" name="Cost" required="required"/>
            </div>
            <div class="ViaggioFileBox">
                <p id="FileName">Aggiungi un'immagine di copertina!</p>
                <!--<input class="ViaggioInput" type="file" id="ViaggioImg"  name="Image" accept="image/*" onchange="getFileName('ViaggioImg','FileName')" required="required"> -->
                <label class ="materialButton flexButton _50" for="ViaggioImg">Seleziona</label>
                <input class="sr-only" type="file" id="ViaggioImg"  name="Image" accept="image/*" onchange="loadFile(event)" required="required"/>

                <p id="anteprimaFoto">Anteprima</p>
                <div id="output"></div>

                <?php session_start();
                if ($_SESSION["errorTripPicture_1"] == true){
                    echo ("<p class='danger'>Formato non valido. Carica una foto in JPG o PNG.</p>");
                    $_SESSION['errorTripPicture_1'] = false;
                }
                else if ($_SESSION["errorTripPicture_2"] == true){
                    echo ("<p class='danger'>Immagine non selezionata. Carica una foto in JPG o PNG.</p>");
                    $_SESSION['errorTripPicture_2'] = false;
                }
                else if ($_SESSION["errorTripPicture_3"] == true){
                    echo ("<p class='danger'>L'immagine è oltre le dimensioni massime consentite. Carica una foto inferiore a 8MB.</p>");
                    $_SESSION['errorTripPicture_3'] = false;
                }
                else if ($_SESSION["errorTripPicture"] == true){
                    echo ("<p class='danger'>C'è stato un errore con il caricamento dell'immagine, ti invitiamo a riprovare.</p>");
                    $_SESSION['errorTripPicture'] = false;
                }
                else if($_SESSION["errorTripBianco"] == true){
                    echo ("<p class='danger'>I campi nome e comune non possono essere lasciati vuoti.</p>");
                    $_SESSION['errorTripBianco'] = false;
                }
                ?>
            </div>
            <hr id="ViaggioButtonSeparator">
                <button type="submit" class="materialButton _50">Aggiungi</button>
        </form>
    </div>
</div>