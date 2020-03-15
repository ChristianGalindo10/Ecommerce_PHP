<?php
error_reporting(0);
$db = new MyDB();
include "configs/funciones.php";

/*
$sql =<<<EOF
SELECT * from Usuario;
EOF;

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
   echo "name = ". $row['n_username'] . "\n";
   // add the BR tag to print the values in a new line    
   echo "pass = ". $row['o_pass'] ."\n";
   echo "<br>";
}
echo "Operation done successfully\n";
$db->close();*/



	
if(isset($enviar)){
	
	$username = clear($username);
	$password = clear($password);
	/*
	$q = $mysqli->query("SELECT * FROM admins WHERE username = '$username' AND password = '$password'");

	if(mysqli_num_rows($q)>0){
		$r = mysqli_fetch_array($q);
		$_SESSION['id'] = $r['id'];
		redir("?p=admin");
	}else{
		alert("Los datos no son validos");
		redir("?p=admin");
	}
	$username=$_REQUEST['username']; 
	$password=$_REQUEST['password']; */
	
	$sql =<<<EOF
SELECT * FROM Usuario WHERE n_username = '$username' AND o_pass = '$password';
EOF;

$ret = $db->query($sql);
$rows = 0;

while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
   $rows+=1;
	echo "name = ". $row['n_username'] . "\n";
   // add the BR tag to print the values in a new line    
   echo "pass = ". $row['o_pass'] ."\n";
   echo "<br>";
}

if($rows>0){
	$r = $ret->fetchArray(SQLITE3_ASSOC);
	$_SESSION['id'] = $r['k_id'];
	echo "bien";
}else{
	echo "mal";
}

echo "Operation done successfully\n".$rows;
$db->close();

/*
   $sql =<<<EOF
      INSERT INTO Usuario (n_username,o_pass)
      VALUES ('$username', '$password' );
EOF;


   $ret = $db->exec($sql);
   
   if(!$ret){
	//echo $db->lastErrorMsg();
	//echo '<script language="javascript">alert("Datos erroneos");</script>';
	echo"<script type=\"text/javascript\">alert('!Datos erroneos, intente nuevamente');</script>"; 
	//redir("?p=ingresar");
   } else {
	echo"<script type=\"text/javascript\">alert('Datos correctos');window.location='index.php'</script>"; 
   }
   $db->close();*/


}

if(isset($_SESSION['id'])){ // si hay una sesion iniciada
	
	?>
	<a href="?p=agregar_producto">
		<button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar Productos</button></a>

		<a href="?p=agregar_categoria">
		<button class="btn btn-info"><i class="fa fa-plus-circle"></i> Agregar Categoria</button></a>

		<a href="?p=manejar_tracking">
		<button class="btn btn-warning"><i class="fa fa-plus-circle"></i> Manejar Tracking</button></a>
	<?php
	unset($_SESSION['id']);
}else{ // si no hay una sesion iniciada
	
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
	</center>
	
	<?php
}
?>