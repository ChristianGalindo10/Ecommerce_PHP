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

<section id="catalogo">
        <h3>Lo último de nuestro catálogo</h3>
        <div class="contenedor">


<?php
$db = new MyDB();
$sql =<<<EOF
SELECT * FROM Producto ORDER BY k_idP ASC;
EOF;

$ret = $db->query($sql);

while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    ?>
    <article class="item2">
        <a><img class="zoom" src="img/<?=$row['o_img']?>"></a>
        <h4><?=$row['n_nomProdu']?></h4>
        <span class="precio"><?=$row['v_precio']?> USD</span>
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
</script>

