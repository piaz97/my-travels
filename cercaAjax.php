<?php
    include_once ("funzioni.php");
    session_start();
    $ris = stampaItinerariRicerca();
    echo "$ris";
    include("include/pagination.php");
