<?php
$configs= include('include/config.php');
try {
    session_start();
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $command="Select Username, Reputazione from Utente ORDER BY Reputazione DESC";

    $stmt = $conn->prepare($command);
    $stmt->execute();
    $ris = $stmt->fetchAll(PDO::FETCH_BOTH);
    echo ("        
		<div id='podioClassifica'>
			<div id='primoClassifica'>
				<div class='iconaPodio'>
					<img src='img/gold-medal.svg' alt=\"primo classificato\"/>
				</div>
				<div class='puntiClassifica'>
					<p>".$ris[0][1]."</p>
				</div>
				<div class='ProfileBoxClassifica'>
					<p>".$ris[0][0]."</p>
					<div class='containerProfilePicture'>
					    <img alt='Foto profilo primo classificato' src='profilePictures/".$ris[0][0].".jpg?".time()."'/>
					</div>
				</div>
			</div>	
			<div id='secondoClassifica'>
				<div class='iconaPodio'>
					<img src='img/silver-medal.svg' alt=\"secondo classificato\"/>
				</div>
				<div class='puntiClassifica'>
					<p>".$ris[1][1]."</p>
				</div>
				<div class='ProfileBoxClassifica'>
					<p>".$ris[1][0]."</p>
					<div class='containerProfilePicture'>
					    <img alt='Foto profilo secondo classificato' src='profilePictures/".$ris[1][0].".jpg?".time()."'/>
					</div>
				</div>
			</div>	
			<div id='terzoClassifica'>
				<div class='iconaPodio'>
					<img src='img/bronze-medal.svg' alt=\"terzo classificato\"/>
				</div>
				<div class='puntiClassifica'>
					<p>".$ris[2][1]."</p>
				</div>
				<div class='ProfileBoxClassifica'>
					<p> ".$ris[2][0]."</p>
					<div class='containerProfilePicture'>
					    <img alt='Foto profilo terzo classificato' src='profilePictures/".$ris[2][0].".jpg?".time()."'/>
					</div>
				</div>
			</div>	
		</div>"
    );
    echo("<table id='tabellaClassifica'>
            <caption>
                Nella tabella viene fornita la classifica degli utenti del sito dalla numero 4 alla numero 30
            </caption>
			<tr>
				<th id='col1' abbr='pos' scope='col' class='posizioneClassifica'>Posizione</th>
				<th id='col2' abbr='user' scope='col' lang='en'>Username</th>
				<th id='col3' abbr='punti' scope='col' class='punteggioClassifica'>Punteggio</th>
			</tr>	");
    for ($i = 3; $i <= 29; $i++){
        echo("<tr>
				<th headers='col1' id=\"riga".($i+1)."\" scope='row' class='posizioneClassifica'>".($i+1)."</th>
				<td headers='col2 riga".($i+1)."' >".$ris[$i][0]."</td>
				<td headers='col3 riga".($i+1)."' class='punteggioClassifica'>".$ris[$i][1]."</td>
			</tr>
            ");
    }

    echo("</table>");

    if (!isset($_SESSION['username'])){
        echo("<table id='utenteClassifica'>
               <caption class='sr-only'>La tua posizione</caption>
                <tr>
                    <td class='posizioneClassifica'></td>
                    <td>Accedi per conoscere la tua posizione</td>
                    <td class='punteggioClassifica'></td>                
                    </tr>
            </table>
         ");
    }
    else {
        echo("<table summary='La tua posizione' id='utenteClassifica'>
                <tr>
                    <td class='posizioneClassifica'>" . (array_search($_SESSION["username"], array_column($ris, 'Username')) + 1) . "</td>
                    <td >" . $_SESSION["username"] . "</td>
                    <td class='punteggioClassifica'>" . $_SESSION["reputazione"] . "</td>
                </tr>
            </table>
         ");
    }

}
catch(PDOException $e)
{
    header("Location: lost.php");
}
