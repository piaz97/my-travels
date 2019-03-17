<!-- PARTE LOGIN -->
<div id="logincanvas" class="LoginModal hidden">
    <div class="LoginContainer animate">
        <div class="LoginImgContainer">
            <a  aria-label="chiudi popup del login" class="sr-only" href="javascript:closePopup('logincanvas')">Chiudi popup</a>
            <span onclick="closePopup('logincanvas')" class="LoginClose">&times;</span>
            <img src="img/logo.svg" alt="logo MyTravels" class="LoginAvatar"/>
        </div>
        <form action="login.php" method="post">
            <div class="LoginInputContainer">
                <div class="LoginInputBox">
                    <img src="img/username.svg" alt="icona username" class="LoginInputIcon"/>
                    <label class="sr-only" for="loginUsername" lang="en">Username</label>
                    <input  id="loginUsername"  class="LoginInput" type="text" placeholder="Username" name="username" required="required"/>
                </div>
                <div class="LoginInputBox">
                    <img src="img/locked.svg" alt="icona password" class="LoginInputIcon"/>
                    <label class="sr-only" for="loginPassword" lang="en">Password</label>
                    <input class="LoginInput" id="loginPassword" type="password" placeholder="Password" name="password" required="required"/>
                    <img  onclick="showpwd()" id="pwdeyelog" alt="nascondi/mostra password" class="LoginViewEye" src="img/view.svg"/>
                </div>
            </div>
            <hr class="LoginHr"/>

            <div id="loginError" class="message danger<?php session_start(); if(isset($_SESSION["loginMessage"])) echo " shown";?>">
                <em>Errore:</em> Le credenziali inserite non sono corrette
            </div>
            <div class="LoginButtonContainer">
                <button type="button" id="loginButton"  class="materialButton _50">Accedi</button>
            </div>
            <p>Non hai un account?<a id="linkLoginPopup" href="javascript:openPopup('registrazionecanvas')" class="LoginLink">&nbsp;Registrati</a></p>
        </form>
    </div>
</div>