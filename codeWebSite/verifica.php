<?php
	session_start(); //inizio sessione
	//inclusione file per collegamento al db con script di accesso
	include("connessione_db.php");
	include("config.php");
	//conn
	mysqli_select_db($conn,"$db_name");
	//variabili POST con anti sqlInjection (escape caratteri
	//potenzialmente dannosi)
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$password=crypt($password,'$2a$07$usesomesillystringforsalt$');
	$query = "SELECT *
	FROM credenziali
	WHERE email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$query)){
		echo "Errore SQL";
	}
	else{
		mysqli_stmt_bind_param($stmt,"s",$email);
		mysqli_stmt_execute($stmt);

	}
    $result = mysqli_stmt_get_result($stmt); 	
	
    $riga = mysqli_fetch_array($result);
	if (hash_equals($password, $riga['password'])){
		$trovato=1;
	}
	else
	$trovato = 0 ;
	if($trovato) { //Email e password corrette
		$_SESSION['abilitato'] = 1;
		$_SESSION['cod'] = $riga['id_utente']; //Registro il codice utente
		/*Redirect alla pagina riservata*/
		echo '<script
		language=javascript>document.location.href="areaPersonale.php"
		</script>';
	}
	else {
		/*Username e password errati, redirect alla pagina di login*/
		// per ora rimanda qui, appena faccio css, me lo devi rimanda in un altro che ha il quadratino rosso con un punto esclamativo
		echo '<script
		language=javascript>alert("Email e/o password errate/a, riprova");
		document.location.href="login.php" 
		</script>';
	}
?>