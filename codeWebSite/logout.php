<?php
session_start();
$_SESSION = array();
session_destroy(); //distruggo tutte le sessioni
//creazione variabile messaggio
$msg = "Informazioni: logout effettuato con successo.";
//informazioni-logout-effettuato-con-successo
$msg = urlencode($msg); // invio messaggio via get
//ritorno a index.php usando GET è possibile visualizzare il messaggio di
//avvenuto logout
header("location: login.php?msg=$msg");
exit();
?>