<!-- PARTE REGISTRAZIONE -->
<div id="registrazionecanvas" class="LoginModal hidden">
    <div class="LoginContainer animate">
        <div class="LoginImgContainer">
            <a   aria-label="chiudi popup del login" class="sr-only" href="javascript:closePopup('registrazionecanvas')">Chiudi popup</a>
            <span onclick="closePopup('registrazionecanvas')" class="LoginClose">&times;</span>
            <img src="img/logo.svg" alt="Logo MyTravels" class="LoginAvatar"/>
        </div>
        <!-- FORM BEGINNING -->
        <form id="registrationForm" action="registrazione.php" method="post" class="<?php session_start(); if(isset($_SESSION["registrationSuccess"])) echo "hidden"; else echo "shown";?>">
            <div class="LoginInputContainer">
                <div class="LoginInputBox">
                    <img src="img/username.svg" alt="username" class="LoginInputIcon"/>
                    <label class="sr-only" for="username" lang="en">Username</label>
                    <input id="username" class="LoginInput" type="text" placeholder="Username" name="username" required="required"/>
                </div>
                <div id="error-username" class="message danger">
                    <em>Errore:</em> Username già in uso
                </div>
                <div id="error-username-length" class="message danger">
                    <em>Errore:</em> Lo username deve essere lungo almeno 4 caratteri
                </div>
                <div id="error-username-spazi" class="message danger">
                    <em>Errore:</em> Lo username non può contenere spazi
                </div>


                <div class="LoginInputBox">
                    <img src="img/envelope.svg" alt="email" class="LoginInputIcon"/>
                    <label class="sr-only" for="mail" lang="en">E-mail</label>
                    <input  id="mail" class="LoginInput" type="email" placeholder="Email" name="mail" required="required"/>
                </div>

                <div id="error-mail" class="message danger">
                        <em>Errore:</em> Email già in uso
                </div>
                <div id="error-mail-format" class="message danger">
                    <em>Errore:</em> Formato email errato
                </div>

                <div class="LoginInputBox">
                    <img src="img/locked.svg" alt="icona password" class="LoginInputIcon"/>
                    <label class="sr-only" for="pwdreg" lang="en">Password</label>
                    <input  class="LoginInput" id="pwdreg" type="password" placeholder="Password" name="password"  required="required"/>
                    <img  onclick="showpwd()" alt="mostra/nascondi password"  class="LoginViewEye" id="pwdeyereg" src="img/view.svg"/>
                </div>
                <div id="error-pswd-length" class="message danger">
                    <em>Errore:</em> La password deve contenere almeno 8 caratteri
                </div>
                <!-- An element to toggle between password visibility -->

                <div class="LoginInputBox">
                    <img src="img/locked.svg" alt="icona password" class="LoginInputIcon"/>
                    <label class="sr-only" for="pwd-repeat">Ripeti password</label>
                    <input class="LoginInput" id="pwd-repeat" type="password" placeholder="Ripeti Password" name="passwordRepeat" required="required"/>
                    <img onclick="showrepeatpwd()" alt="mostra/nascondi password" class="LoginViewEye" id="pwdeyeregrep" src="img/view.svg"/>
                </div>
                <div id="error-pswd" class="message danger">
                        <em>Errore:</em> Le due password non coincidono
                </div>
                <div id="registrationError" class="message danger<?php session_start(); if(isset($_SESSION["registrationError"])) echo " shown";?>">
                    <em>Errore: &nbsp;</em><?php echo $_SESSION["registrationError"];?>
                </div>
            </div>
            <hr class="LoginHr"/>
            <div class="LoginButtonContainer">
                <button type="button" id="registerButton"  class="materialButton _70 script" >Registrati</button>
            </div>

            <div class="script">
                <p>Hai gia' un account?<a id="linkRegistrazionePopup" href="javascript:openPopup('logincanvas')" class="LoginLink">&nbsp;Accedi</a></p>
            </div>
        </form>
        <div id="registrationSuccess" class="message success<?php session_start(); if(isset($_SESSION["registrationSuccess"])) echo " shown";?>">
            <em>Evviva! </em> La registrazione è avvenuta con successo. <a href="javascript:openPopup('logincanvas')" class="LoginLink">Accedi</a>
        </div>


    </div>
</div>