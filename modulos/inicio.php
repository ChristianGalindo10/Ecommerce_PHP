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
            ?>
            <!--
            <article class="item">
                <a href=""><img class="zoom" src="img/dbzk.jpg"></a>
                <h4>Dragon Ball Z Kakarot</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/nfs.jpg"></a>
                <h4>Need For Speed</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/pubg.jpg"></a>
                <h4>PlayerUnknown´s Battlegrounds</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/fh4.jpg"></a>
                <h4>Forza Horizon 4</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/gtav.jpg"></a>
                <h4>Grand Theft Auto V</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/minecraft.png"></a>
                <h4>Minecraft</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/ff7.jpeg"></a>
                <h4>Final Fantasy VII</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/fornite.jpg"></a>
                <h4>Fortnite</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/apex.jpg"></a>
                <h4>Apex Legends</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>
            <article class="item">
                <a href=""><img class="zoom" src="img/fifa20.jpeg"></a>
                <h4>FIFA 20</h4>
                <a href="">
                    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos distinctio ex
                        odit
                        debitis a cum
                        dolorum facere! Distinctio, sequi, optio blanditiis earum sint ut hic nam alias, odit
                        laboriosam
                        repellat.</p>
                </a>
            </article>-->
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