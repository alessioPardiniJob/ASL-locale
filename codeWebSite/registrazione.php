<script >
function Modulo() {
	// Variabili associate ai campi del modulo
	var codice_tessera = document.modulo.codice_tessera.value;
	var codFisc = document.modulo.codFisc.value;
	var nome = document.modulo.nome.value;
	var cognome = document.modulo.cognome.value;
	var sesso = document.modulo.sesso.value;
	var data_nascita = document.modulo.data_nascita.value;
	var nazionalita = document.modulo.nazionalita.value;
	var comune = document.modulo.comune.value;
	var indirizzo_residenza = document.modulo.indirizzo_residenza.value;
	var cap_residenza = document.modulo.cap_residenza.value;
	var indirizzo_domicilio = document.modulo.indirizzo_domicilio.value;
	var cap_domicilio = document.modulo.cap_domicilio.value;
	var telefono = document.modulo.telefono.value;
	var telefono_casa = document.modulo.telefono_casa.value;
	var email = document.modulo.email.value;
	var password = document.modulo.password.value;
	var conferma = document.modulo.conferma.value;
	var agree_term = document.getElementById('agree');
	// Espressione regolare dell'email
	var email_reg_exp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
	var lenCodiceTessera = codice_tessera.toString().length;
	var lenCapResidienza = cap_residenza.toString().length;
	var lenCapRDomicilio = cap_domicilio.toString().length;
	var check=/^[A-Za-z]+[à,è,ì,ò,ù]$/;
	//Effettua il controllo sul campo codice_tessera
	if ((codice_tessera == "") || (codice_tessera == "undefined")) {
	alert("Il campo Codice Tessera è obbligatorio.");
	document.modulo.codice_tessera.focus();
	return false;
	}
	if(isNaN(codice_tessera)){
		alert("Il campo Codice Tessera è numerico.");
		document.modulo.codice_tessera.focus();
		return false;
	}	
	if(lenCodiceTessera != 20){
		alert("Inserire il Codice Tessera di dimensione corretta (20 cifre).");
		//document.modulo.conferma.value = "";
		document.modulo.codice_tessera.focus();
		return false;
	}
	//Effettua il controllo sul campo codFisc
	if ((codFisc == "") || (codFisc == "undefined")) {
		alert("Il campo Codice Fiscale è obbligatorio.");
		document.modulo.codFisc.focus();
		return false;
	}
	if(codFisc.length != 16){
		alert("Inserire il Codice Fiscale di dimensione corretta (16 caratteri).");
		document.modulo.codFisc.focus();
		return false;
	}
	if(codFisc != codFisc.toUpperCase()){
		alert("I caratteri del Codice Fiscale devono essere maiuscoli.");
		document.modulo.codFisc.focus();
		return false;
	}
	

	//Effettua il controllo sul campo nome
	if ((nome == "") || (nome == "undefined")) {
	alert("Il campo Nome è obbligatorio.");
	document.modulo.nome.focus();
	return false;
	}
	if(!check.test(nome)){
	alert("Il campo Nome può contenere esclusivamente lettere.");
	document.modulo.nome.focus();
	return false;
	}
	if(nome != (nome.charAt(0).toUpperCase() + nome.slice(1))){
		nome = nome.charAt(0).toUpperCase() + nome.slice(1);
	}
	
	//Effettua il controllo sul campo cognome
	if ((cognome == "") || (cognome == "undefined")) {
	alert("Il campo Cognome è obbligatorio.");
	document.modulo.cognome.focus();
	return false;
	}
	if(!check.test(cognome)){
	alert("Il campo Cognome può contenere esclusivamente lettere.");
	document.modulo.cognome.focus();
	return false;
	}
	if(cognome != (cognome.charAt(0).toUpperCase() + cognome.slice(1))){
		cognome = cognome.charAt(0).toUpperCase() + cognome.slice(1);
	}
	
	//Effettua il controllo sul campo sesso
	if ((sesso == "") || (sesso == "undefined")) {
	alert("Il campo Sesso è obbligatorio.");
	document.modulo.sesso.focus();
	return false;
	}
	
	//Effettua il controllo sul campo data_nascita
	if ((data_nascita == "") || (data_nascita == "undefined")) {
	alert("Il campo Data Nascita è obbligatorio.");
	document.modulo.data_nascita.focus();
	return false;
	}
	
	//Effettua il controllo sul campo nazionalita
	if ((nazionalita == "") || (nazionalita == "undefined")) {
	alert("Il campo Nazionalita è obbligatorio.");
	document.modulo.nazionalita.focus();
	return false;
	}
	if(!check.test(nazionalita)){
	alert("Il campo Nazionalita può contenere esclusivamente lettere.");
	document.modulo.nazionalita.focus();
	return false;
	}
	if(nazionalita != (nazionalita.charAt(0).toUpperCase() + nazionalita.slice(1))){
		nazionalita = nazionalita.charAt(0).toUpperCase() + nazionalita.slice(1);
	}
	
	//Effettua il controllo sul campo comune
	if ((comune == "") || (comune == "undefined")) {
	alert("Il campo Comune è obbligatorio.");
	document.modulo.comune.focus();
	return false;
	}
	if(!check.test(comune)){
	alert("Il campo Comune può contenere esclusivamente lettere.");
	document.modulo.comune.focus();
	return false;
	}
	if(comune != (comune.charAt(0).toUpperCase() + comune.slice(1))){
		comune = comune.charAt(0).toUpperCase() + comune.slice(1);
	}
	
	//Effettua il controllo sul campo indirizzo_residenza
	if ((indirizzo_residenza == "") || (indirizzo_residenza == "undefined")) {
	alert("Il campo Indirizzo Residienza è obbligatorio.");
	document.modulo.indirizzo_residenza.focus();
	return false;
	}
	
	//Effettua il controllo sul campo cap_residenza
	if ((cap_residenza == "") || (cap_residenza == "undefined")) {
	alert("Il campo Cap Residienza è obbligatorio.");
	document.modulo.cap_residenza.focus();
	return false;
	}
	if(isNaN(cap_residenza)){
		alert("Il campo cap residienza è numerico.");
		document.modulo.cap_residenza.focus();
		return false;
	}
	if(lenCapResidienza!=5){
		alert("Inserire il Cap Residenza di dimensione corretta (5 cifre).");
		document.modulo.cap_residenza.focus();
		return false;
	}
	
	//Effettua il controllo sul campo indirizzo_domicilio
	if ((indirizzo_domicilio == "") || (indirizzo_domicilio == "undefined")) {
	alert("Il campo Indirizzo Domicilio è obbligatorio.");
	document.modulo.indirizzo_domicilio.focus();
	return false;
	}

	//Effettua il controllo sul campo cap_domicilio
	if ((cap_domicilio == "") || (cap_domicilio == "undefined")) {
	alert("Il campo Cap Domicilio è obbligatorio.");
	document.modulo.cap_domicilio.focus();
	return false;
	}
	if(lenCapRDomicilio != 5){
		alert("Inserire il Cap Domicilio di dimensione corretta (5 cifre).");
		document.modulo.cap_domicilio.focus();
		return false;
	}
	if(isNaN(cap_domicilio)){
		alert("Il campo Cap Domicilio è numerico.");
		document.modulo.cap_domicilio.focus();
		return false;
	}
	
	//Effettua il controllo sul campo telefono
	if ((telefono == "") || (telefono == "undefined")) {
	alert("Il campo Telefono è obbligatorio.");
	document.modulo.telefono.focus();
	return false;
	}
	if(isNaN(telefono)){
		alert("Il campo telefono è numerico.");
		document.modulo.telefono.focus();
		return false;
	}
	if(telefono.length!=10){
		alert("Inserire il Numero di Telefono di dimensione corretta (10 cifre).");
		document.modulo.telefono.focus();
		return false;
	}
	
	
	//Effettua il controllo sul campo telefono_casa
	else if ((telefono_casa == "") || (telefono_casa == "undefined")) {
	alert("Il campo Telefono Casa è numerico ed obbligatorio.");
	document.modulo.telefono_casa.value = "";
	document.modulo.telefono_casa.focus();
	return false;
	}
	if(isNaN(telefono_casa)){
		alert("Il campo telefono casa è numerico.");
		document.modulo.telefono.focus();
		return false;
	}
	
	//Effettua il controllo sul campo email
	if ((email == "") || (email == "undefined")) {
	alert("Il campo Email è obbligatorio.");
	document.modulo.email.focus();
	return false;
	}
	if (!email_reg_exp.test(email)) {
	alert("Inserire un indirizzo email corretto.");
	document.modulo.email.select();
	return false;
	}
	//Effettua il controllo sul campo PASSWORD
	if ((password == "") || (password == "undefined")) {
	alert("Il campo Password è obbligatorio.");
	document.modulo.password.focus();
	return false;
	}
	//controllo numeri
	var x=0;
	var check1 = /[([0-9])]/;
	if(check1.test(password)){
		x = x + 20;
	}
	//controllo minuscole
	var check2=/[a-z]/;
	if(check2.test(password)){
		x = x + 20;
	}
	//controllo maiuscole
	var check3=/[A-Z]/;
	if(check3.test(password)){
		x = x + 20;
	}
	//controllo simboli
	var check4=/[$-/:-?{-~!"^_`\[\]]/;
	if(check4.test(password)){
		x = x + 20;
	}
	// controllo lunghezza (minore o uguale a 10 caratteri)
	if(password.length >=10){
		x = x + 20;
	}
	if(x<60){
	alert("password troppo debole, assicurati che quest'ulitma contenga almeno un carattere minuscolo, almeno un carattere maiuscolo, almeno un numero e una lunghezza maggiore di 9 caratteri.");
	document.modulo.conferma.focus();
	return false;
	}
	//Effettua il controllo sul campo CONFERMA_PASSWORD
	if ((conferma == "") || (conferma == "undefined")) {
	alert("Il campo Conferma Password è obbligatorio.");
	document.modulo.conferma.focus();
	return false;
	}
	//Verifica l'uguaglianza tra i campi PASSWORD e CONFERMA PASSWORD
	if (password != conferma) {
	alert("La password di conferma è differente da quella inizialmente inserito, per favore riserisci.");
	document.modulo.conferma.value = "";
	document.modulo.conferma.focus();
	return false;
	}
	if(agree_term.checked == false){
	alert("Prima di effettuare l'accesso, devi accettare i Termini e condizioni d'uso.");
	document.modulo.agree_term.focus();	
	}

	//INVIA IL MODULO
	else{
	document.modulo.action = "Insert.php";
	document.modulo.submit();
	}
}
function showPwd() {
	var input = document.getElementById('pwd');
	if (input.type === "password") {
		input.type = "text";
	} else {
		input.type = "password";
	}
	}
function showPwd1() {
        var input = document.getElementById('pwd1');
        if (input.type === "password") {
          input.type = "text";
        } else {
          input.type = "password";
        }
      }
</script>
<html>
<title>Registrazione</title>
	<head><link rel = "stylesheet" href="styleR.css"> </head>

<div class="container">
	<form method="post" class="box" name="modulo">
		<h4>Asl<span>Toscana</span></h4>
		<h5>Tutti i campi sono obbligatori.</h5>
		<div class="row">
		<input class="if--input" type="text" name="codice_tessera" placeholder="Codice tessera sanitaria" >
		<input class="if--input" type="text" name="codFisc" placeholder="Codice fiscale" >
		</div>
		<div class="row">
		<input class="if--input" type="text" name="nome"  placeholder="Nome" >
		<input class="if--input" type="text" name="cognome" placeholder="Cognome" >
		</div>
		<div class="row">
		<select class="if--input" name="sesso" >
            <option value=""></option>
            <option value="M">Maschio</option>
            <option value="F">Femmina</option>
		<input class="if--input" type="date" name="data_nascita" required>
		<span class="placeholder"> </span>
	</div>
		<div class="row">
		<input class="if--input" type="text" name="nazionalita" placeholder="Nazionalità" >
		<input class="if--input" type="text" name="comune" placeholder="Comune" >
		</div>
		<div class="row">
		<input class="if--input" type="text" name="indirizzo_residenza" placeholder="Indirizzo di residienza" >
		<input class="if--input" type="text" name="cap_residenza" placeholder="CAP di residienza" >
		</div>
		<div class="row">
		<input class="if--input" type="text" name="indirizzo_domicilio" placeholder="Indirizzo di domicilio" >
		<input class="if--input" type="text" name="cap_domicilio" placeholder="CAP di domicilio" >
		</div>
		<div class="row">
		<input class="if--input" type="text" name="telefono" placeholder="Telefono" >
		<input class="if--input" type="text" name="telefono_casa" placeholder="Telefono casa" >
		</div>
		<div class="row-email-password">
		<input class="if--input" type="text" name="email" placeholder="Email" >
		<input id="pwd" class="if--input" type="password" name="password" placeholder="Password">
		<label class="pass">
		<svg class="vector-image" width="20px" height="30px" viewBox="0 0 488.85 488.85" onclick="showPwd()">
			<g>
				<path d="M244.425,98.725c-93.4,0-178.1,51.1-240.6,134.1c-5.1,6.8-5.1,16.3,0,23.1c62.5,83.1,147.2,134.2,240.6,134.2
					s178.1-51.1,240.6-134.1c5.1-6.8,5.1-16.3,0-23.1C422.525,149.825,337.825,98.725,244.425,98.725z M251.125,347.025
					c-62,3.9-113.2-47.2-109.3-109.3c3.2-51.2,44.7-92.7,95.9-95.9c62-3.9,113.2,47.2,109.3,109.3
					C343.725,302.225,302.225,343.725,251.125,347.025z M248.025,299.625c-33.4,2.1-61-25.4-58.8-58.8c1.7-27.6,24.1-49.9,51.7-51.7
					c33.4-2.1,61,25.4,58.8,58.8C297.925,275.625,275.525,297.925,248.025,299.625z"/>
			</g>
		</svg>
		</label>
		</div>
		<div class="row">
		<input id ="pwd1" class="if--input" type="password" name="conferma" placeholder="Conferma password" >
		<label class="pass">
		<svg class="vector-image" width="20px" height="30px" viewBox="0 0 488.85 488.85" onclick="showPwd1()">
			<g>
				<path d="M244.425,98.725c-93.4,0-178.1,51.1-240.6,134.1c-5.1,6.8-5.1,16.3,0,23.1c62.5,83.1,147.2,134.2,240.6,134.2
					s178.1-51.1,240.6-134.1c5.1-6.8,5.1-16.3,0-23.1C422.525,149.825,337.825,98.725,244.425,98.725z M251.125,347.025
					c-62,3.9-113.2-47.2-109.3-109.3c3.2-51.2,44.7-92.7,95.9-95.9c62-3.9,113.2,47.2,109.3,109.3
					C343.725,302.225,302.225,343.725,251.125,347.025z M248.025,299.625c-33.4,2.1-61-25.4-58.8-58.8c1.7-27.6,24.1-49.9,51.7-51.7
					c33.4-2.1,61,25.4,58.8,58.8C297.925,275.625,275.525,297.925,248.025,299.625z"/>
			</g>
		</svg>
		</label>
		</div>
		<input type="checkbox" name="agree_term" id="agree"/>
		<label class="label-term" for="agree_term" ><span><span></span></span>Accetto le
		dichiarazioni contenute nei <a href="termini.php">Termini e condizioni d'uso</a></label>
		<div class="login-div">Hai già un account?<a href="login.php">Accedi.</a></div>
		<input type="button" value="Registrati" onClick="Modulo()" class="btn1">
	</form>
</div>

</html>
