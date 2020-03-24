<?php
$db = new MyDB();
?>
    
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
    <section id="catalogo">
        <h3>Lo último de nuestro catálogo</h3>
        <div class="contenedor">
            <?php
            $ret = $db->query("SELECT * FROM Producto ORDER BY k_idP ASC");
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                ?>
                <article class="item">
                    <a><img class="zoom" src="img/<?=$row['o_img']?>"></a>
                    <h4><?=$row['n_nomProdu']?></h4>
                    <a>
                        <p class="text"><?=$row['o_desc']?></p>
                    </a>
                </article>   
                <?php
            }
            $db->close();
?>
            
        </div>
    </section>

    <section id="plataforma">
        <h3>PLataformas soportadas</h3>
        <div class="contenedor">
            <div class="info-plat">
                <img src="img/pc.png" alt="">
                <h4>PC</h4>
            </div>
            <div class="info-plat">
                <img src="img/ps.jpg" alt="">
                <h4>PlayStation</h4>
            </div>
            <div class="info-plat">
                <img src="img/wii-u.jpg" alt="">
                <h4>Nintendo Wii U</h4>
            </div>
            <div class="info-plat">
                <img src="img/xbox.jpg" alt="">
                <h4>Xbox</h4>
            </div>
        </div>
    </section>