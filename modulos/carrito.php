<?php
$db = new MyDB();
check_user('carrito');

if(isset($finalizar)){
    //$db = new MyDB();
    $monto = clear($monto_total);
    $id_cliente = clear($_SESSION['k_id']);
    $q = $db->query("INSERT INTO Venta (k_id,f_fecha,v_montoFinal,i_estado) VALUES ('$id_cliente',date('now'),'$monto','0')");
    $sc = $db->query("SELECT * FROM Venta WHERE k_id = '$id_cliente' ORDER BY k_idV DESC LIMIT 1");
    $rc = $sc->fetchArray(SQLITE3_ASSOC);

    $ultima_compra = $rc['k_idV'];

    $q2 = $db->query("SELECT * FROM Carro WHERE k_id = '$id_cliente'");
    while($r2=$q2->fetchArray(SQLITE3_ASSOC)){
        $sp = $db->query("SELECT * FROM Producto WHERE k_idP = '".$r2['k_idP']."'");
		$rp = $sp->fetchArray(SQLITE3_ASSOC);

		$monto = $rp['v_precio']*$r2['q_cantidad'];

		$db->query("INSERT INTO Producto_Venta (k_idV,k_idP,q_cantidad,v_montoProdu) VALUES ('$ultima_compra','".$r2['k_idP']."','".$r2['q_cantidad']."','$monto')");
    }

    $db->query("DELETE FROM Carro WHERE k_id = '$id_cliente'");
    alert("Se ha finalizado la compra",1,"inicio");
    //redir("./");
}

if(isset($eliminar)){
    //$db = new MyDB();
    $eliminar = clear($eliminar);
	$db->query("DELETE FROM Carro WHERE k_idP = '$eliminar'");
	alert("Producto eliminado",1,'carrito');
}

if(isset($id) && isset($modificar)){

	$id = clear($id);
	$modificar = clear($modificar);
	$db->query("UPDATE Carro SET q_cantidad = '$modificar' WHERE k_idP = '$id'");
	alert("Cantidad modificada",1,'carrito');
	//redir("?p=carrito");
}


?>

<h1 id="titulo-tabla"><i class="fa fa-shopping-cart"></i> Carro de Compras</h1>
<br><br>

<table id="main-container">
    <thead>
        <tr>
            <th><i class="fa fa-image"></i></th>
            <th>Nombre del producto</th>
            <th>Copias</th>
            <th>Precio por unidad</th>
            <th>Oferta</th>
            <th>Precio Total</th>
            <th>Action</th>
        </tr>
    </thead>
<?php
    //$db = new MyDB();
    $id_cliente = clear($_SESSION['k_id']);
    $sql =<<<EOF
    SELECT * FROM Carro WHERE k_id = '$id_cliente';
EOF;
    $ret = $db->query($sql);
    $monto_total=0;
    while($r = $ret->fetchArray(SQLITE3_ASSOC)){
        $res = $db->query("SELECT * FROM Producto WHERE k_idP = '".$r['k_idP']."'");
        $r2 = $res->fetchArray(SQLITE3_ASSOC);
        $nombre_producto = $r2['n_nomProdu'];
        $cantidad = $r['q_cantidad'];
        $precio_unidad = $r2['v_precio'];
        $precio_total=0;
        if($r2['v_oferta']>0){
            if(strlen($r2['v_oferta'])==1){
                $desc = "0.0".$r2['v_oferta'];
            }else{
                $desc = "0.".$r2['v_oferta'];
            }
            $precio_total = $r2['v_precio']-($r2['v_precio']*$desc);
        }else{
            $precio_total = $r2['v_precio'];
        }
        $precio_total = $cantidad*$precio_total;
        $imagen_producto = $r2['o_img'];
        $monto_total = $monto_total + $precio_total;
        ?>  
            <tr>
                <td><img src="img/<?=$imagen_producto?>" class="imagen_carro"/></img></td>
                <td><?=$nombre_producto?></td>
                <td><?=$cantidad?></td>
                <td><?=$precio_unidad?> USD</td>
                <td>
                    <?php
                        if($r2['v_oferta']>0){
                            echo $r2['v_oferta']."% de Descuento";
                        }else{
                            echo "Sin descuento";
                        }
                    ?>
                </td>
                <td><?=$precio_total?> USD</td>
                <td>
                    <a  onclick="modificar(<?=$r['k_idP']?>)" href="#"><i class="fa fa-edit" title="Modificar"></i></a>
                    <a  href="?p=carrito&eliminar=<?=$r['k_idP']?>"><i class="fa fa-trash" title="Eliminar"></i></a>
                </td>
            </tr>
        <?php
    }
?>
</table>
<br>
<h2 class="monto">Monto Total: <b class="text-green"><?=$monto_total?> USD</b></h2>
<br><br>
<form method="post" action="">
    <input type="hidden" name="monto_total" value="<?=$monto_total?>"/>
    <button class="btn btn-primary" type="submit" name="finalizar"><i class="fa fa-check"></i>Finalizar compra</button>
</form>

<script type="text/javascript">
    function modificar(idc){
        var new_cant = prompt("¿Cual es la nueva cantidad?");
        if(new_cant>0){
            window.location="?p=carrito&id="+idc+"&modificar="+new_cant;
        }
    }
</script>