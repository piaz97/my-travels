<div id="profileContainer">

        <?php
        include_once("include/profileNavbar.php");
        ?>
        <div id="rightProfile">
            <nav id="breadcrumb" aria-label="Breadcrumbs">
                <span>Ti trovi in:&nbsp;</span>
                <ol>
                    <li>Area Personale</li>
                </ol>
            </nav>
            <div class="sr-only" id="contenutoPagina"></div>
            <div id="profilePhotoContainer">
                <div id="profilePhotoBox">
                    <img <?php echo "src=\"profilePictures/".$_SESSION['username'].".jpg?rd=".filemtime("profilePictures/".$_SESSION['username'].".jpg")."\""?> alt="immagine del profilo"/>
                    <div  class ="materialButton _90" onclick="showDiv(document.getElementById('photoForm'))">Cambia foto</div>

                    <form id="photoForm" action="changeProfileImage.php" method="post" enctype="multipart/form-data" onchange="loadFile(event)">
                        <div>
                            <label class= "materialButton _45 flexButton" for="imageChoose">Scegli</label>
                            <input class="sr-only" type="file" id="imageChoose" name="upload" accept="image/*" required="required"/>
                            <button tabindex="22" type="submit" value="Carica" name="submit" id="imageUpload" class="materialButton _45">Carica</button>

                        </div>

                    </form>
                    <p id="anteprimaFoto">Anteprima</p>
                    <div id="output"></div>
                    <?php if ($_SESSION['successProfilePicture'] == true){
                        echo ("<p class='success'>Immagine profilo cambiata con successo</p>");
                        $_SESSION['successProfilePicture'] = false;
                    }
                    else if ($_SESSION["errorProfilePicture_1"] == true){
                        echo ("<p class='danger'>Formato non valido. Carica una foto in JPG o PNG.</p>");
                        $_SESSION['errorProfilePicture_1'] = false;
                    }
                    else if ($_SESSION["errorProfilePicture_2"] == true){
                        echo ("<p class='danger'>Immagine non selezionata. Carica una foto in JPG o PNG.</p>");
                        $_SESSION['errorProfilePicture_2'] = false;
                    }
                    else if ($_SESSION["errorProfilePicture_3"] == true){
                        echo ("<p class='danger'>L'immagine è oltre le dimensioni massime consentite. Carica una foto inferiore a 8MB.</p>");
                        $_SESSION['errorProfilePicture_3'] = false;
                    }
                    else if ($_SESSION["errorProfilePicture_3"] == true){
                        echo ("<p class='danger'>C'è stato un errore con il caricamento dell'immagine, ti invitiamo a riprovare.</p>");
                        $_SESSION['errorProfilePicture_3'] = false;
                    }
                    ?>
                </div>
                <div id="profileLevelBox">
                    <div>Reputazione: <?php
                        $configs= include('include/config.php');
                        $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
                        // set the PDO error mode to exception
                        try{
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = $conn->prepare("SELECT Reputazione FROM Utente WHERE Username=:username");
                            $query->bindParam(':username',$_SESSION["username"]);
                            $query->execute();
                            $reputazione=$query->fetchAll(PDO::FETCH_BOTH);
                            echo ($reputazione[0]["Reputazione"]) ;
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                        ?> </div>
                    <img src="img/crown.svg" alt="reputazione">
                </div>
            </div>

            <div id="profileDataContainer">
                <h1><?php echo $_SESSION['username']; ?> </h1>
                <div class="profileDataBox">
                    <h2>Nome:</h2>
                    <p><?php echo $_SESSION['nome'];?></p>
                </div>
                <div class="profileDataBox">
                    <h2>Cognome:</h2>
                    <p><?php echo $_SESSION['cognome'];?></p>
                </div>
                <div class="profileDataBox">
                    <h2>Sesso:</h2>
                    <p><?php echo $_SESSION['sesso'];?></p>
                </div>
                <div class="profileDataBox">
                    <h2>Data di nascita:</h2>
                    <p><?php echo $_SESSION['dataNascita'];?></p>
                </div>
                <div class="profileDataBox">
                    <h2>Email:</h2>
                    <p><?php echo $_SESSION['mail'];?></p>
                </div>
                <div class="profileDataBox">
                    <h2>Modifica i dati:</h2>
                    <a tabindex="23" class="materialButton _30 flexButton" href="#profileModificaContainer" onclick="showDiv(document.getElementById('profileModificaContainer'))">Modifica</a>
                </div>
                <div class="profileDataBox">
                    <h2>Cancella account:</h2>
                    <div tabindex="24" class="materialButton _30 flexButton" onclick="showDiv(document.getElementById('profileConfirmDelete'))">Cancella</div>
                </div>
                <div class="profileDataBox" id="profileConfirmDelete">
                    <h2>Confermi di voler cancellare l'account?</h2>
                    <a tabindex="25" class="materialButton dangerButton flexButton _30" href="deleteUtente.php">Confermo</a>
                </div>
                <div id="modifyError" class="message danger<?php session_start(); if(isset($_SESSION["modifyError"])) echo " shown";?>">
                    <em>Errore: &nbsp;</em><?php echo $_SESSION["modifyError"]; unset($_SESSION["modifyError"]);?>
                </div>
                <?php if (isset($_SESSION['successModification'])){
                    echo ("<p class='success'>Modifiche effettuate con successo</p>");
                    unset($_SESSION['successModification']);
                }
                ?>

            </div>

            <div id="profileModificaContainer">
                <h1>Modifica i tuoi dati: </h1>
                <form action="modificaProfilo.php" method="post">
                <div id="modificaDataContainer">
                    <div class="profileDataBox">
                        <label for="FirstName">Nome:</label>
                        <input class="form-style-1" type="text" id="FirstName" name="FirstName"
                            <?php if(isset($_SESSION['nome'])) echo "placeholder=\"".$_SESSION['nome']."\"";?>/><br/>
                    </div>
                    <div class="profileDataBox">
                        <label for="LastName">Cognome:</label>
                        <input class="form-style-1" type="text" id="LastName" name="LastName"
                            <?php if(isset($_SESSION['cognome']))echo "placeholder=\"".$_SESSION['cognome']."\"";?>/><br/>
                    </div>

                    <div class="profileDataBox">
                        <label for="DateBirth">Data di nascita:</label>
                        <input class="form-style-1" type="date" id="DateBirth" name="DateBirth"
                            <?php if(isset($_SESSION['data']))echo " value=\"".$_SESSION['data']."\"";?> />
                    </div>

                    <div class="profileDataBox">
                        <label for="Email">E-mail:</label>
                        <input class="form-style-1" type="email" id="Email" name="Email"
                            <?php if(isset($_SESSION['mail'])) echo "placeholder=\"".$_SESSION['mail']."\"";?> />
                    </div>
                    <div class="profileDataBox">
                        <label for="Password">Password:</label>
                        <input class="form-style-1" minlength="8" type="password" id="Password" name="Password" placeholder= "&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" />
                    </div>

                    <div class="profileDataBox">
                        <fieldset>
                            <legend>Scelta del sesso:</legend>
                            <input type="radio" id="Gender1" name="Gender" value="Maschio"/> <label for="Gender1" class="profileRadioGender">Maschio</label>
                            <input type="radio" id="Gender2" name="Gender" value="Femmina"/> <label for="Gender2" class="profileRadioGender">Femmina</label>
                            <input type="radio" id="Gender3" name="Gender" value="Altro"/> <label for="Gender3">Altro</label>
                        </fieldset>
                    </div>
                </div>

                <button tabindex="26" class="materialButton _45" type="submit" value="Modifica">
                    Modifica
                </button>
                </form>
            </div>

        </div>
    </div>