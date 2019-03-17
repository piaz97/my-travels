
    <!-- dopo sostituire con una parte in php che cambia la classe e l'immagine del profilo
    <div id="boxLoggedImgContainer">
        <a href="area_personale.php"><img alt=""/></a>
    </div>

    <div id="boxLoggedDataContainer">
        <h1></h1>
        <a tabindex="8" href="area_personale.php">PROFILO</a>
        <a tabindex="9" href="logout.php">ESCI</a>
    </div>
    -->
    <div id="login">
        <img id="user-logo" onclick="openNav('menu-login');" <?php echo "src=profilePictures/".$_SESSION['username'].".jpg?".time()?> alt=""/>
        <div id="menu-login">
            <a href="javascript:closeNav('menu-login')"  class="exitButton">
                <img src="img/close.svg" alt=""/>
            </a>
            <ul>
                <li  id="areaPersonaleLink">
                    <a tabindex="6" href="area_personale.php">
                        <img src="img/user.svg" alt=""/>
                        <div class="login-text">Area Personale</div>
                    </a>
                </li>
                <li id="logoutLink">
                    <a tabindex="7" href="logout.php">
                        <img src="img/log-out.svg" alt="" />
                        <div class="login-text">Logout</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>




