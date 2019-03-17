<div id="profileContainer">
    <?php
    include_once("include/profileNavbar.php");
    ?>
    <div id="rightTravels">
        <nav id="breadcrumb" aria-label="Breadcrumbs">
            <span>Ti trovi in:&nbsp;</span>
            <ol>
                <li><a href="area_personale.php">Area personale</a></li>
                <li>I miei viaggi</li>
            </ol>
        </nav>
        <div id="contenutoPagina" class="sr-only"></div>
        <?php
            include_once ("funzioni.php");
            trovaItinerariProfilo();
            stampaItinerariProfilo();
        ?>
    </div>
</div>