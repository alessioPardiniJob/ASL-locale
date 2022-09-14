<?php include('config.php'); ?>
<!DOCTYPE html>
<script>
function showPwd() {
	var input = document.getElementById('pwd');
	if (input.type === "password") {
		input.type = "text";
	} else {
		input.type = "password";
	}
}

</script>

<html>
	<head>
	
		<!-- Inserire qui eventuali CSS -->
		<title>Login</title>
		<link rel="stylesheet" href="styleL.css">
	</head>

	<body>	
		<div class="container">
		<form id="login" action="verifica.php" method="post">
		<h4>Asl<span>Toscana</span></h4>
		<h5>Tutti i campi sono obbligatori.</h5>
		<div class="inputs">
			<input class="if--input" id="email" name="email" type="text"
			placeholder="Inserisci email" autofocus required>
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
			<input id="pwd" class="if--input" id="password" name="password" type="password"
			placeholder="Inserisci password" required>
		</div>
		<div class="paragrafo">Non sei ancora registrato?<a href="registrazione.php" id="back">Registrati!</a></div>
		<input type="submit" value="Login" class="btn1">
				
		</form>
		</div>
	</body>
</html>