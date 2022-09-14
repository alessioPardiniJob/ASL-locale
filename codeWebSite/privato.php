<?php
   session_start();
   include("connessione_db.php");
   include("config.php");
   $id_cartella_clinica=$_POST['id_cartella_clinica'];
   $codice_tessera = $_SESSION['cod'];
   // query per ottenere i dati relativi ad una cartella clinica
   $queryCartella = "SELECT cartellaClinica.* 
   FROM cartellaClinica
   WHERE codice_tessera = ? ";
   //caso in cui si visualizza nello specifico
   if($id_cartella_clinica != '*'){
		$queryCartella.=" AND id_cartella_clinica=?;";
      $stmtCartella = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmtCartella,$queryCartella)){
         echo "Errore SQL";
      }
      else{
         mysqli_stmt_bind_param($stmtCartella,"ss",$codice_tessera, $id_cartella_clinica);
         $resultCartella=mysqli_stmt_execute($stmtCartella);
      }
      $resultCartella = mysqli_stmt_get_result($stmtCartella); 	
   }
   //caso in cui si visualizza tutto
   else{
      $stmtCartella = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmtCartella,$queryCartella)){
      echo "Errore SQL";
      }
      else{
      mysqli_stmt_bind_param($stmtCartella,"s", $codice_tessera);
      $resultCartella=mysqli_stmt_execute($stmtCartella);
      }
      $resultCartella = mysqli_stmt_get_result($stmtCartella); 
   }
   // query per ottenere i dati relativi ai report
   $queryReport = "SELECT report.*, operatore.nome, operatore.cognome
             FROM report, operatore 
             WHERE report.matricola = operatore.matricola 
             AND codice_tessera = ?";
   //caso in cui si visualizza nello specifico
	if($id_cartella_clinica != '*'){
		$queryReport.=" AND id_cartella_clinica=?;";
      $stmtReport = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmtReport,$queryReport)){
         echo "Errore SQL";
      }
      else{
         mysqli_stmt_bind_param($stmtReport,"ss",$codice_tessera,$id_cartella_clinica);
         $resultReport=mysqli_stmt_execute($stmtReport);
      }
      $resultReport = mysqli_stmt_get_result($stmtReport); 	
   }
   //caso in cui si visualizza tutto
   else{
      $stmtReport = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmtReport,$queryReport)){
         echo "Errore SQL";
      }
      else{
         mysqli_stmt_bind_param($stmtReport,"s",$codice_tessera);
         $resultReport=mysqli_stmt_execute($stmtReport);
      }
      $resultReport = mysqli_stmt_get_result($stmtReport); 	
   }
   // query per ottenere il risultato analisi per un determinato esame
   $queryAnalisi = "SELECT risultato_analisi, id_esame, data_prenotazione, id_cartella_clinica, codice_tessera 
   FROM analisi, provetta
   WHERE analisi.id_analisi = provetta.id_analisi 
   AND codice_tessera = ?";
   //caso in cui si visualizza nello specifico
   if($id_cartella_clinica != '*'){
		$queryAnalisi.=" AND id_cartella_clinica=?;";
      $stmtAnalisi = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmtAnalisi,$queryAnalisi)){
         echo "Errore SQL";
      }
      else{
         mysqli_stmt_bind_param($stmtAnalisi,"ss",$codice_tessera, $id_cartella_clinica);
         $resultAnalisi=mysqli_stmt_execute($stmtAnalisi);
      }
      $resultAnalisi = mysqli_stmt_get_result($stmtAnalisi); 	
   }
   //caso in cui si visualizza tutto
   else{
      $stmtAnalisi = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmtAnalisi,$queryAnalisi)){
      echo "Errore SQL";
      }
      else{
      mysqli_stmt_bind_param($stmtAnalisi,"s", $codice_tessera);
      $resultAnalisi=mysqli_stmt_execute($stmtAnalisi);
      }
      $resultAnalisi = mysqli_stmt_get_result($stmtAnalisi); 
   }	
  ?>
<html>
 <head>
  <title>Cartella clinica</title>
 </head>
 <body>
 <!--Visualizzazione cartella clinica-->
 <table border>
   <caption><b>Cartella clinica</b></caption>
   <thead>
    <tr>
     <th>Identificativo della cartella clinica</th>
     <th>Codice della tessera</th>
     <th>Data inizio</th>
     <th>Data fine</th>
     <th>codice fiscale del medico curante</th>
     <th>Temperatura (gradi)</th>
     <th>Peso (kg)</th>
     <th>Descrizione</th>
    </tr>
   </thead>
   <tbody>
    <?php
     
     while ($row = mysqli_fetch_assoc($resultCartella)){
    ?>
           <tr>          
            <td><?php echo ($row['id_cartella_clinica']); ?></td>
            <td><?php echo ($row['codice_tessera']); ?></td>
            <td><?php echo ($row['data_inizio']); ?></td>
            <td><?php echo ($row['data_fine']); ?></td>
            <td><?php echo ($row['cf_medico_curante']); ?></td>
            <td><?php echo ($row['temperatura_gradi']); ?></td>
            <td><?php echo ($row['peso_kg']); ?></td>
            <td><?php echo ($row['descrizione']); ?></td>
           </tr>
    <?php
    }
     mysqli_free_result($resultCartella);
     echo "</tbody>\n";
     echo "</table>\n";
    ?>

<!--Visualizzazione Report-->
 <?php
 if (mysqli_num_rows($resultReport) == 0){
      echo("Nessun report trovato.");
      echo("<br>");
     }else{
?>
  <table border>
   <caption><b>Report</b></caption>
   <thead>
    <tr>
     <th>Identificativo esame</th>
     <th>Data prenotazione esame</th>
     <th>Identificativo della cartella clinica</th>
     <th>Codice della tessera</th>
     <th>Identificativo operatore</th>
     <th>Nome operatore</th>
     <th>Cognome operatore</th>
     <th>Data e ora inizio esame</th>
     <th>Data e ora fine esame</th>
     <th>Descrizione</th>
    </tr>
   </thead>
   <tbody>
    <?php
     
     while ($row = mysqli_fetch_assoc($resultReport)){
    ?>
           <tr>
            <td><?php echo ($row['id_esame']); ?></td>
            <td><?php echo ($row['data_prenotazione']); ?></td>           
            <td><?php echo ($row['id_cartella_clinica']); ?></td>
            <td><?php echo ($row['codice_tessera']); ?></td>
            <td><?php echo ($row['matricola']); ?></td>
            <td><?php echo ($row['nome']); ?></td>
            <td><?php echo ($row['cognome']); ?></td>
            <td><?php echo ($row['dataOra_inizio']); ?></td>
            <td><?php echo ($row['dataOra_fine']); ?></td>
            <td><?php echo ($row['descrizione']); ?></td>
           </tr>
    <?php
    }
     mysqli_free_result($resultReport);
     echo "</tbody>\n";
     echo "</table>\n";
   }
    ?>
<?php 
if (mysqli_num_rows($resultAnalisi) == 0){
   echo("Nessun analisi trovata.");
   echo("<br>");
  }else{
?>
<table border>
   <caption><b>Analisi</b></caption>
   <thead>
    <tr>
     <th>Risultato delle analisi</th>
     <th>identificativo dell'esame</th>
     <th>Data prenotazione esame</th>
     <th>Identificativo della cartella clinica</th>
     <th>Codice della tessera</th>
    </tr>
   </thead>
   <tbody>
    <?php
    
     while ($row = mysqli_fetch_assoc($resultAnalisi)){
    ?>
           <tr>
            <td><?php echo ($row['risultato_analisi']); ?></td>
            <td><?php echo ($row['id_esame']); ?></td>
            <td><?php echo ($row['data_prenotazione']); ?></td>           
            <td><?php echo ($row['id_cartella_clinica']); ?></td>
            <td><?php echo ($row['codice_tessera']); ?></td>
           </tr>
    <?php
    }
     mysqli_free_result($resultAnalisi);
     echo "</tbody>\n";
     echo "</table>\n";
     mysqli_close($conn);
   }
    ?>
   <label>Torna alla <a href="areaPersonale.php">home</a></label>
   <button> 
      <a href="logout.php">Logout</a> 
   </button>
 </body>
</html>
