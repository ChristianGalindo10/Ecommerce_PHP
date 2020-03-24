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

    $db->close();
?>