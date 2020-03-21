<?php
$db = new MyDB();
check_user('compras');
?>

<h1 id="titulo-tabla"><i class="fa fa-shopping-cart"></i> Mis compras</h1>
<br><br>

<?php
    $id_cliente = clear($_SESSION['k_id']);
    $sql =<<<EOF
    SELECT * FROM Venta WHERE k_id = '$id_cliente';
EOF;
    $ret = $db->query($sql);
    $rows=0;
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $rows+=1;
    }
    
    if($rows>0){
        ?>
        
        <table id="main-container">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Monto total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        <?php
            while($r = $ret->fetchArray(SQLITE3_ASSOC)){
                $res = $db->query("SELECT * FROM Producto_Venta WHERE k_idV = '".$r['k_idV']."'");
                $fecha = $r['f_fecha'];
                $monto_total = $r['v_montoFinal'];
                    ?>  
                        <tr>
                            <td><?=$fecha?></td>
                            <td><?=$monto_total?> USD</td>
                            <td>
                                <a href="?p=ver_compra&id=<?=$r['k_idV']?>">
					                <i class="fa fa-eye" title="Ver"></i>
                                </a>
                            </td>
                        </tr>   
                    <?php
            }
        ?>
            </table> 
        <?php
    }else{
        ?>
            <br>
            <br>
            <i>Usted no ha realizado ninguna compra</i>
        <?php
    }



/*
<table id="main-container">
    <thead>
        <tr>
            <th>Fecha</th>
            <th><i class="fa fa-image"></i></th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Descuento</th>
            <th>Monto total</th>
        </tr>
    </thead>*/

    //$db = new MyDB();
    //$id_cliente = clear($_SESSION['k_id']);
    //$sql =<<<EOF
    //SELECT * FROM Venta WHERE k_id = '$id_cliente';
//EOF;
    //$ret = $db->query($sql);
    //$rows=0;
    //while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        //$rows+=1;
    //}

    //if($rows>0){

    //}
    /*
    while($r = $ret->fetchArray(SQLITE3_ASSOC)){
        $res = $db->query("SELECT * FROM Producto_Venta WHERE k_idV = '".$r['k_idV']."'");
        $r2 = $res->fetchArray(SQLITE3_ASSOC);
        $res2 = $db->query("SELECT * FROM Producto WHERE k_idP = '".$r2['k_idP']."'");
        $r3 = $res2->fetchArray(SQLITE3_ASSOC);
        $nombre_producto = $r3['n_nomProdu'];
        $cantidad = $r2['q_cantidad'];
        $precio_unidad = $r3['v_precio'];
        $fecha = $r['f_fecha'];
        $precio_total=0;
        $monto_total=0;
        if($r3['v_oferta']>0){
            if(strlen($r3['v_oferta'])==1){
                $desc = "0.0".$r3['v_oferta'];
            }else{
                $desc = "0.".$r3['v_oferta'];
            }
            $precio_total = $r3['v_precio']-($r3['v_precio']*$desc);
        }else{
            $precio_total = $r3['v_precio'];
        }
        $monto_total=$precio_total*$r2['q_cantidad'];
        $imagen_producto = $r3['o_img'];*/
        /*
        ?>  
            <tr>
                <td><?=$fecha?></td>
                <td><img src="img/<?=$imagen_producto?>" class="imagen_carro"/></img></td>
                <td><?=$nombre_producto?></td>
                <td><?=$cantidad?></td>
                <td><?=$precio_unidad?> USD</td>
                <td>
                    <?php
                        if($r3['v_oferta']>0){
                            echo $r3['v_oferta']."% de Descuento";
                        }else{
                            echo "Sin descuento";
                        }
                    ?>
                </td>
                <td><?=$monto_total?> USD</td>
            </tr>
        <?php
    }
?>
</table>*/