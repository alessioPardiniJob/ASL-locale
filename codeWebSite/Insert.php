
<?php
include("connessione_db.php");
	//gestione parametri per effettuare query
	$codice_tessera = mysqli_real_escape_string($conn,$_POST['codice_tessera']);
	$codice_fiscale = mysqli_real_escape_string($conn,$_POST['codFisc']);
	$nome = mysqli_real_escape_string($conn,$_POST['nome']);
	$cognome = mysqli_real_escape_string($conn,$_POST['cognome']);
	$sesso = mysqli_real_escape_string($conn,$_POST['sesso']);
	$data_nascita = mysqli_real_escape_string($conn,$_POST['data_nascita']);
	$nazionalita = mysqli_real_escape_string($conn,$_POST['nazionalita']);
	$comune = mysqli_real_escape_string($conn,$_POST['comune']);
	$indirizzo_residenza = mysqli_real_escape_string($conn,$_POST['indirizzo_residenza']);
	$cap_residenza = mysqli_real_escape_string($conn,$_POST['cap_residenza']);
	$indirizzo_domicilio = mysqli_real_escape_string($conn,$_POST['indirizzo_domicilio']);
	$cap_domicilio = mysqli_real_escape_string($conn,$_POST['cap_domicilio']);
	$telefono = mysqli_real_escape_string($conn,$_POST['telefono']);
	$telefono_casa = mysqli_real_escape_string($conn,$_POST['telefono_casa']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);
	
	//conversione da Stringa a intero per il campo CAP, poichè all'interno del DB quest'ultimo è intero e non string
	$cap_residenza=(int)$cap_residenza;
	$cap_domicilio=(int)$cap_domicilio;
	
	// valutare opzione priorita $priorita=1;
	//cripto la password
	$password=crypt($password,'$2a$07$usesomesillystringforsalt$');
	//controllo email se esiste gia
	$controllo_email = "SELECT email FROM credenziali WHERE email = ?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$controllo_email)){
		echo "Errore SQL";
	}
	else{
		mysqli_stmt_bind_param($stmt,"s",$email);
		mysqli_stmt_execute($stmt);
	}
    $resultControllo = mysqli_stmt_get_result($stmt); 	
	
    $row = mysqli_fetch_array($resultControllo);
    if (mysqli_num_rows($resultControllo) != 0) {
			echo "Email già registrata, impossibile registrarsi usando questo indirizzo email.";
			echo "<br>";
			echo "<br>";
			echo "<button><a href='registrazione.php'>Email già registrata, impossibile registrarsi usando questo indirizzo email.</a></button>";
			die();
	}		
	//query registrazione credenziali relative al paziente
	$queryCredenziali = "INSERT INTO credenziali(id_utente, email, password) VALUES (?,?,?);";
	
	$stmtCredenziali = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmtCredenziali,$queryCredenziali)){
		echo "Errore SQL";
	}
	else{
		mysqli_stmt_bind_param($stmtCredenziali,"sss",$codice_tessera,$email,$password);
		$resultCredenziali=mysqli_stmt_execute($stmtCredenziali);
	}

	//query registrazione del paziente nel database
	$queryPaziente = "INSERT INTO paziente(codice_tessera, codice_fiscale, nome, cognome,
	sesso, data_nascita, nazionalita, comune, indirizzo_residenza, cap_residenza,
	indirizzo_domicilio, cap_domicilio,telefono,telefono_casa) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

	$stmtPaziente = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmtPaziente,$queryPaziente)){
		echo "Errore SQL";
	}
	else{
		mysqli_stmt_bind_param($stmtPaziente,"sssssssssisiss",$codice_tessera,$codice_fiscale,$nome,$cognome,$sesso,$data_nascita,$nazionalita,$comune,$indirizzo_residenza,
		$cap_residenza,$indirizzo_domicilio,$cap_domicilio,$telefono,$telefono_casa);
		$resultPaziente=mysqli_stmt_execute($stmtPaziente);
	}

	if($resultCredenziali && $resultPaziente){
			echo '<script language=javascript>
			alert("Registrazione completata");
			document.location.href="login.php";
			</script>';
	}
	else{
		echo '<script language=javascript>
		alert("Registrazione fallita! Utente gia registrato");
		document.location.href="login.php";
		</script>';
	}
?>