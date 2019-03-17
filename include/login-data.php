<noscript>
    <a id="mobileLoginReplacement" href="#mobileNoScriptLogin">JS disabilitato</a>
</noscript>
<div id="login">
    <img id="user-logo" onclick="openNav('menu-login');" <?php echo "src=\"profilePictures/".$_SESSION['username'].".jpg?rd=".filemtime("profilePictures/".$_SESSION['username'].".jpg")."\""?> alt="icona-login"/>
    <div id="menu-login">
        <a href="javascript:closeNav('menu-login')"  class="exitButton">
            <img src="img/close.svg" alt="icona chiudi menu"/>
        </a>
        <ul>
            <li  id="areaPersonaleLink">
                <a href="area_personale.php">
                    <img src="img/user.svg" alt="icona area personale"/>
                    <div class="login-text">Area Personale</div>
                </a>
            </li>
            <li id="logoutLink">
                <a href="logout.php">
                    <img src="img/log-out.svg" alt="icona logout" />
                    <div class="login-text">Logout</div>
                </a>
            </li>
        </ul>
    </div>
</div>




