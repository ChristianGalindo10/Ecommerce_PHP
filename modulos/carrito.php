<?php
if(isset($finalizar)){
    $db = new MyDB();
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

		$monto = $rp['v_precio'];

		$db->query("INSERT INTO Producto_Venta (k_idVenta,k_idProdu,q_cantidad,v_monto) VALUES ('$ultima_compra','".$r2['k_idP']."','".$r2['q_cantidad']."','$monto')");
    }

    $db->query("DELETE FROM Carro WHERE k_id = '$id_cliente'");
    alert("Se ha finalizado la compra");
    redir("./");
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
            <th>Precio Total</th>
        </tr>
    </thead>
<?php
    $db = new MyDB();
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
        $precio_total = $cantidad*$precio_unidad;
        $imagen_producto = $r2['o_img'];
        $monto_total = $monto_total + $precio_total;
        ?>  
            <tr>
                <td><img src="img/<?=$imagen_producto?>" class="imagen_carro"/></td>
                <td><?=$nombre_producto?></td>
                <td><?=$cantidad?></td>
                <td><?=$precio_unidad?> USD</td>
                <td><?=$precio_total?> USD</td>
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