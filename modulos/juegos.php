<section id="banner">
        <div class="slider">
            <ul>
                <li><img src="img/banner.jpg"></li>
                <li><img src="img/banner3.jpg"></li>
            </ul>
        </div>
        <div class="contenedor">
            <h2>Juegos multiplataforma</h2>
            <p>¿Cuál es el mejor juego para usted?</p>
            <a href="#">Leer más</a>

        </div>
    </section>

    <section id="bienvenidos">
        <h2>Bienvenidos a nuestro catálogo</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur enim et soluta sequi culpa, non
            blanditiis molestiae obcaecati rem distinctio!</p>
</section>


 <?php
    $db = new MyDB();
    if(isset($cat)){
        
        $sc = $db->query("SELECT * FROM Categoria WHERE k_idCat='$cat'");
        $rc = $sc->fetchArray(SQLITE3_ASSOC);
        ?>
            <h3 id="titulo-cat">Categoria filtrada por: <?=$rc['n_nomCat']?></h3>
        <?php
    }
 ?>

<section id="catalogo">
        <div class="contenedor">
            
            <select id="categoria" onchange="redir_cat()"class="form-control">
                <option value="">Seleccione una categoria para filtrar</option>
                <?php
                    //$db = new MyDB();
                    $cats = $db->query("SELECT * FROM Categoria ORDER BY n_nomCat ASC");
                    while($rcat = $cats->fetchArray(SQLITE3_ASSOC)){
                        ?>
                            <option value="<?=$rcat['k_idCat']?>"><?=$rcat['n_nomCat']?></option>
                        <?php
                    }
                ?>
            </select>


<?php
check_user("juegos");
//$db = new MyDB();

if(isset($agregar) && isset($cant)){
    $idp = clear($agregar);
    $cant = clear($cant);
    $id_cliente = clear($_SESSION['k_id']);
    $v = $db->query("SELECT * FROM Carro WHERE k_id = '$id_cliente' AND k_idP = '$idp'");
    $rows=0;
    while($row = $v->fetchArray(SQLITE3_ASSOC) ){
        $rows+=1;
    }
    if($rows>0){
        $ret = $db->query("UPDATE Carro set q_cantidad = q_cantidad + $cant WHERE k_id = '$id_cliente' AND k_idP = '$idp'");
    }else{
        $ret = $db->query("INSERT INTO Carro (k_idP,k_id,q_cantidad) VALUES ($idp,$id_cliente,$cant)");
        /*
        $sql =<<<EOF
    INSERT INTO Carro (k_idP,k_id,q_cantidad) VALUES ($idp,$id_cliente,$cant);
EOF;
    $ret = $db->query($sql);*/
    }
    alert("Se ha agregado al carro",2,'juegos');
    //redir("?p=juegos");        
}
if(isset($cat)){
    $ret = $db->query("SELECT * FROM Producto WHERE k_idCat='$cat' ORDER BY k_idP ASC");
}else{
    $ret = $db->query("SELECT * FROM Producto ORDER BY k_idP ASC");
}
/*
$sql =<<<EOF
SELECT * FROM Producto ORDER BY k_idP ASC;
EOF;

$ret = $db->query($sql);*/

while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    
    $precio_total=0;
    if($row['v_oferta']>0){
        if(strlen($row['v_oferta'])==1){
            $desc = "0.0".$row['v_oferta'];
        }else{
            $desc = "0.".$row['v_oferta'];
        }
        $precio_total = $row['v_precio']-($row['v_precio']*$desc);
    }else{
        $precio_total = $row['v_precio'];
    }
    
    ?>
    <article class="item2">
        <a><img class="zoom" src="img/<?=$row['o_img']?>"></a>
        <h4><?=$row['n_nomProdu']?></h4>
        <?php
            if($row['v_oferta']>0){
                ?>
                    <del class="precio"><?=$row['v_precio']?> USD</del> <span class="precio"><?=$precio_total?> USD</span>
                <?php
            }else{
                ?>
                    <span class="precio"><?=$row['v_precio']?> USD</span>
                <?php
            }
        ?>
        <button class="boton-agregar" onclick="agregar_carro('<?=$row['k_idP']?>');"><i class="fa fa-shopping-cart"></i></button>
    </article>
    <?php
 }

?>
    </div>
</section>

<script type="text/javascript">
    function agregar_carro(idp){
        var cant = prompt("¿Qué cantidad desea agregar?",1);
        if(cant.length>0){
		window.location="?p=juegos&agregar="+idp+"&cant="+cant;
	    }
    }

    function redir_cat(){
        window.location = "?p=juegos&cat="+categoria.value;
    }
</script>

