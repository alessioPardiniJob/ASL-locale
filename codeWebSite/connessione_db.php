<?php
$conn = mysqli_connect("localhost", "root", "", "asl");
   if (mysqli_connect_errno($conn)){
      die("Errore di connessione al DBMS My-SQL.");
   }
?>  