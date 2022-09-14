<?php
   session_start();
   include("connessione_db.php");
   include("config.php");
   $codice_tessera = $_SESSION['cod'];
   //query esami
    $queryEsami = "SELECT esame.* 
    FROM esame,(
    SELECT id_esame, data_prenotazione
                FROM report 
                    WHERE codice_tessera=? 
                    AND data_prenotazione < CURRENT_DATE()) AS t1
    WHERE esame.id_esame = t1.id_esame AND esame.data_prenotazione = t1.data_prenotazione;;";

   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt,$queryEsami)){
      echo "Errore SQL";
   }
   else{
      mysqli_stmt_bind_param($stmt,"s",$codice_tessera);
      $result=mysqli_stmt_execute($stmt);
   }
   $result = mysqli_stmt_get_result($stmt); 	

   if (mysqli_num_rows($result) == 0){
      echo("Nessun esame fatto.");
      ?>
      <label>Torna alla <a href="areaPersonale.php">home</a></label>
      <button> 
         <a href="logout.php">Logout</a> 
      </button>
   <?php
      die();
   }
  ?>
<html>
 <head>
  <title>Esami</title>
 </head>
 <body>
  
  <table border>
   <caption><b>Esami fatti</b></caption>
   <thead>
    <tr>
     <th>Identificativo esame</th>
     <th>Data prenotazione esame</th>
     <th>Identificativo prestazione</th>
     <th>Temperatura corporea (gradi)</th>
     <th>Pressione sanguigna (mmHG)</th>
     <th>Frequenza respiratoria (atti al minuto)</th>
     <th>Ossigenazione sanguigna (percentuale)</th>
     <th>Frequenza cardiaca (bpm)</th>
    </tr>
   </thead>
   <tbody>
    <?php
     while ($row = mysqli_fetch_assoc($result)){
    ?>
           <tr>
            <td><?php echo ($row['id_esame']); ?></td>
            <td><?php echo ($row['data_prenotazione']); ?></td>           
            <td><?php echo ($row['id_prestazione']); ?></td>
            <td><?php echo ($row['temperatura_corporea_gradi']); ?></td>
            <td><?php echo ($row['pressione_sanguigna_mmHG']); ?></td>
            <td><?php echo ($row['frequenza_respiratoria_attiMinuto']); ?></td>
            <td><?php echo ($row['ossigenazione_sanguigna_percentuale']); ?></td>
            <td><?php echo ($row['frequenza_cardiaca_bpm']); ?></td>
           </tr>
    <?php
    }
     mysqli_free_result($result);
     echo "</tbody>\n";
     echo "</table>\n";
     mysqli_close($conn);
    ?>
   <label>Torna alla <a href="areaPersonale.php">home</a></label>
   <button> 
      <a href="logout.php">Logout</a> 
   </button>
 </body>
</html>
