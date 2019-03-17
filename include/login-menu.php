<noscript><a id="mobileLoginReplacement" href="#mobileNoScriptLogin">JS disabilitato</a></noscript>
<div id="login">
    <!-- dopo sostituire con una parte in php che cambia la classe e l'immagine del profilo -->
    <img id="user-logo" onclick="openNav('menu-login');" src="img/user.svg" alt="icona menu"/>
    <div id="menu-login">
        <a href="javascript:closeNav('menu-login')"  class="exitButton">
            <img src="img/close.svg" alt="chiudi menu login"/>
        </a>
       <ul>
            <li  id="loginLink">
                <noscript>
                    <a href="login-page.php">
                        <img src="img/log-in.svg" alt="icona login"/>
                        <div class="login-text">Accedi</div>
                    </a>
                </noscript>
                <div class="script">
                    <a  href="javascript:openPopup('logincanvas')">
                        <img src="img/log-in.svg" alt="icona login"/>
                        <div class="login-text">Accedi</div>
                    </a>
                </div>
            </li>
           <?php
                include_once("include/registrazione-include.php");
           ?>
            <li id="registrationLink">
                <noscript>
                    <a href="registrazione-page.php">
                        <img src="img/add-user.svg" alt="icona registrazione" />
                        <div class="login-text">Registrati</div>
                    </a>
                </noscript>
                <div class="script">
                    <a  href="javascript:openPopup('registrazionecanvas')">
                        <img src="img/add-user.svg" alt="icona registrazione" />
                        <div class="login-text">Registrati</div>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<?php
    include_once("include/login-include.php");
    ?>