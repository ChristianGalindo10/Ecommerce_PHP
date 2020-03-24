<?php
$db = new MyDB();
	
if(isset($enviar)){
	$username = clear($username);
	$password = clear($password);
	$cpassword = clear($cpassword);

	$q = $db->query("SELECT * FROM Usuario WHERE n_username = '$username'");
    $rows = 0;

    while($row = $q->fetchArray(SQLITE3_ASSOC)){
        $rows+=1;
    }

	if($rows>0){
		alert("El usuario ya está en uso",0,'registro');
		die();
	}

	if($password != $cpassword){
		alert("Las contraseñas no coinciden",0,'registro');
		die();
	}



	$db->query("INSERT INTO Usuario (n_username,o_pass) VALUES ('$username','$password')");


	$q2 = $db->query("SELECT * FROM Usuario WHERE n_username = '$username'");

	$r = $q2->fetchArray(SQLITE3_ASSOC);

	$_SESSION['k_id'] = $r['k_id'];

	alert("Te has registrado satisfactoriamente",1,'inicio');
	$db->close();
	//redir("./");

}
	?>


	<center>
		<form method="post" action="">
			<div class="centrar_login">
				<label><h2><i class="fa fa-key"></i> Registrate</h2></label>
				<div class="form-group">
					<input type="text" autocomplete="off" class="form-control" placeholder="Usuario" name="username"/>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirmar Contraseña" name="cpassword"/>
				</div>

				<div class="form-group">
					<button class="btn btn-submit" name="enviar" type="submit"><i class="fas fa-sign-in-alt"></i> Registrate</button>
				</div>
			</div>
		</form>
	</center>