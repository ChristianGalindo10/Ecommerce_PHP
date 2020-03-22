<?php

$db = new MyDB();


if(isset($enviar)){
	
	$username = clear($username);
	$password = clear($password);

	$sql =<<<EOF
SELECT * FROM Usuario WHERE n_username = '$username' AND o_pass = '$password';
EOF;

$ret = $db->query($sql);
$rows = 0;

while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
   $rows+=1;
}

if($rows>0){
	$r = $ret->fetchArray(SQLITE3_ASSOC);
	$_SESSION['k_id'] = $r['k_id'];
	if(isset($return)){
		$db->close();
		redir("?p=".$return);
	}else{
		$db->close();
		redir("./");
	}
	
}else{
	$db->close();
	alert("Los datos no son válidos",0,'ingresar');
}

}

?>

<center>
		<form method="post" action="">
			<div class="centrar_login">
				<label><h2><i class="fa fa-key"></i> Iniciar Sesión</h2></label>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Usuario" name="username"/>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>

				<div class="form-group">
					<button class="btn btn-submit" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>
				</div>
			</div>
		</form>
		<br>
		<br>
		<a href="?p=registro">¿Aun no tiene una cuenta?</a>
</center>

