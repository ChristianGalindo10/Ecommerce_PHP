<?php
include "configs/abrirBD";


function clear($var){
	htmlspecialchars($var);
	return $var;
}


function redir($var){
	?>
	<script>
		window.location="<?=$var?>";
	</script>
	<?php
	die();
}

function alert($txt,$type,$url){

	if($type==0){
		$t = "error";
	}elseif($type==1){
		$t = "success";
	}elseif($type==2){
		$t = "info";
	}else{
		$t = "info";
	}
	echo '<script>swal({ title: "Alerta", text: "'.$txt.'", icon: "'.$t.'"});';
	echo '$(".swal-button").click(function(){ window.location="?p='.$url.'"; });';
	echo '</script>';
}

function check_user($url){

	if(!isset($_SESSION['k_id'])){
		redir("?p=ingresar&return=$url");
	}else{
		//nombre_cliente($_SESSION['k_id']);
		
	}

}

function nombre_cliente($id_cliente){
	
	$db = new MyDB();

	$sql =<<<EOF
SELECT * FROM Usuario WHERE k_id = '$id_cliente';
EOF;

$ret = $db->query($sql);
$row = $ret->fetchArray(SQLITE3_ASSOC);
return $row['n_username'];
}


function estado($id_estado){
		if($id_estado == 0){
			$status = "Iniciando";
		}elseif($id_estado==1){
			$status = "Preparando";
		}elseif($id_estado == 2){
			$status = "Despachando";
		}elseif($id_estado == 3){
			$status = "Finalizado";
		}else{
			$status = "Indefinido";
		}

		return $status;

}

?>