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

        </div>
    </section>

    <section id="bienvenidos">
        <h2>Bienvenidos a nuestro catálogo</h2>
        <p>En este catálogo encontraras juegos de acción,deportes,mundo abierto entre otros para 
            diferentes plataformas como Pc,PlayStation,Nintendo Wii U y Xbox</p>
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
check_user("ofertas");

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
    }
    alert("Se ha agregado al carro",1,'juegos');      
}
if(isset($cat)){
    $ret = $db->query("SELECT * FROM Producto WHERE k_idCat='$cat' AND v_oferta>0 ORDER BY k_idP ASC");
}else{
    $ret = $db->query("SELECT * FROM Producto WHERE v_oferta>0 ORDER BY k_idP ASC");
}

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
        <del class="precio"><?=$row['v_precio']?> USD</del> <span class="precio"><?=$precio_total?> USD</span>
        <button class="boton-agregar" onclick="agregar_carro('<?=$row['k_idP']?>');"><i class="fa fa-shopping-cart"></i></button>
    </article>
    <?php
 }

?>
    </div>
</section>

<script type="text/javascript">
    function agregar_carro(idp){
        var cant = prompt("¿Qué cantidad de copias desea agregar?",1);
        if(cant.length>0){
		window.location="?p=ofertas&agregar="+idp+"&cant="+cant;
	    }
    }

    function redir_cat(){
        window.location = "?p=ofertas&cat="+categoria.value;
    }
</script>

