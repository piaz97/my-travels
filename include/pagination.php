<?php
    #starto la sessione per prendere le info relative agli indici e poter calcolare
    #che classe assegnare ad ogni box
    session_start();
    ###############
    # Valore da inserire nei box del pagination non utilizzabili
    ###############
    $NOT_ACCESSIBLE_PLACEHOLDER ='-';
    ###############
    # se non ci sono risultati allora non ha senso di esserci la lista pagine
    ###############
    if(isset($_SESSION["searchResults"])){
        $pagination_class = "pagination";
        ###############
        # devo impostare tutte le classi ed i contenuti ai diversi campi
        # classe link e contenuto, sono tre array che contengono rispettivamente la classe della li, il link
        # alla pagina ed il contenuto del link
        ###############
        $classe = [];
        $link = [];
        $contenuto = [];

        foreach ($_SESSION['pages'] as $nome_campo => $indice_campo){
            #allora il campo deve essere segnato con il placeholder
            #il primo e l'ultimo devono avere la classe outerPage
            if($nome_campo == 'back' || $nome_campo == 'next')
                $classe[$nome_campo] = 'outerPage';
            #il current o i fuori range devono avere la classe disabled
            else
                $classe[$nome_campo] = 'innerPage';

            if($nome_campo == "current" || $indice_campo<1 || $indice_campo >$_SESSION['maxPages'])
                $classe[$nome_campo] = 'disabledPage';

            if($indice_campo<1 || $indice_campo >$_SESSION['maxPages']){
                $link[$nome_campo] = $NOT_ACCESSIBLE_PLACEHOLDER;
                $contenuto[$nome_campo] = $NOT_ACCESSIBLE_PLACEHOLDER;
            }
            else{
                $link[$nome_campo] = "?page=".$indice_campo;
                if ($nome_campo == 'back')
                    $contenuto[$nome_campo] = '&laquo;';
                else if ($nome_campo == 'next')
                    $contenuto[$nome_campo] = '&raquo;';
                else
                    $contenuto[$nome_campo] = $indice_campo;
            }
        }#end foreach
        ###############
        # stampa della pagination
        ###############
        echo "<ul class=\"pagination\">";
        foreach ($_SESSION['pages'] as $nome_campo => $indice_campo){
            $riga = "<li class=\"".$classe[$nome_campo]."\">";
            if($classe[$nome_campo] == 'disabledPage')
                $riga.= $contenuto[$nome_campo];
            else {
                $riga .= "<a href=\"cerca.php".$link[$nome_campo]."\">" . $contenuto[$nome_campo] . "</a>";
            }
            $riga .= "</li>";
            echo $riga;
        }


        echo "</ul>";
    }

?>


