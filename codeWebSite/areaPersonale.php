<?php
session_start();
//controllo
if($_SESSION['abilitato'] != 1){
    echo ("<script language=javascript> alert('Effettua il login, prima di accedere alla pagina.'); 
    document.location.href='login.php';</script>");
}
//inclusione file per collegamento al db con script di accesso
include("connessione_db.php");
include("config.php");
mysqli_select_db($conn,"$db_name");

$codice_tessera = $_SESSION['cod'];
//Prepared query (sql injection), per ottenere dati anagrafica
$query = "SELECT paziente.*
FROM paziente
WHERE codice_tessera = ?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query)){
    echo "Errore SQL";
}
else{
    mysqli_stmt_bind_param($stmt,"s",$codice_tessera);
    $result=mysqli_stmt_execute($stmt);
}
$result = mysqli_stmt_get_result($stmt); 	

$riga = mysqli_fetch_array($result);

//Prepared query (sql injection),per ottenere dati cartella clinica
$queryCartellaClinica = "SELECT cartellaClinica.*
FROM cartellaClinica
WHERE codice_tessera = ?;";

$stmtCartella = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmtCartella,$queryCartellaClinica)){
    echo "Errore SQL";
}
else{
    mysqli_stmt_bind_param($stmtCartella,"s",$codice_tessera);
    mysqli_stmt_execute($stmtCartella);

}
$resultCartellaClinica = mysqli_stmt_get_result($stmtCartella);
 
?>

<html>
<head>
    <title>Area Personale</title>
</head>
<body>
<!--Visualizzazione anagrafica-->
    <h4>Area Personale  <?php echo($riga['nome']. " "); echo($riga['cognome']);?></h4>
    <div class="datiPersonali">
        <label>Codice Tessera: <?php echo($riga['codice_tessera']. " ");?></label><br>
        <label>Codice Fiscale: <?php echo($riga['codice_fiscale']. " ");?></label><br>
        <label>Sesso: <?php echo($riga['sesso']. " ");?></label><br>
        <label>Data di nascita: <?php echo($riga['data_nascita']. " ");?></label><br>
        <label>Nazionalita: <?php echo($riga['nazionalita']. " ");?></label><br>
        <label>Comune: <?php echo($riga['comune']. " ");?></label><br>
        <label>Indirizzo di residenza: <?php echo($riga['indirizzo_residenza']. " ");?></label><br>
        <label>Cap di residenza: <?php echo($riga['cap_residenza']. " ");?></label><br>
        <label>Indirizzo di domicilio: <?php echo($riga['indirizzo_domicilio']. " ");?></label><br>
        <label>Cap di domicilio: <?php echo($riga['cap_domicilio']. " ");?></label><br>
        <label>Telefono: <?php echo($riga['telefono']. " ");?></label><br>
        <label>Telefono di casa: <?php echo($riga['telefono_casa']. " ");?></label><br>
    </div>
    <div>
    <br>
    <form action="privato.php" method="POST">
        <?php 
         if (mysqli_num_rows($resultCartellaClinica)==0){
            echo("<label>Non è stata trovata nessuna cartella clinica </label><br>");
         }
         else{
            echo("<label>Selezione la tua cartella clinica </label><br>");
            echo "<select name='id_cartella_clinica'>";
            while ($rigaCartellaClinica=mysqli_fetch_assoc($resultCartellaClinica))
            {
                echo "<option value=".$rigaCartellaClinica["id_cartella_clinica"].">".$rigaCartellaClinica["id_cartella_clinica"];
            } // chiusura while
            echo"<option value='*' selected>Visualizza tutte";
            echo"<input type='submit' value='Invio'>";
        }
        ?>
    </div>
    <div>
    <button> 
         <a href="esamiFatti.php">Visualizza dati relativi agli esami fatti</a> 
    </button>
    <button> 
         <a href="esamiDaFare.php">Visualizza dati relativi agli esami da fare o fatti in data odierna</a> 
    </button>
    </div>
      <button> 
         <a href="logout.php">Logout</a> 
      </button>
</body>
</html>