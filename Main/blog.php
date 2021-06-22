<?php
    require "includes/funciones.php";
    includeTemplate("header");
    ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro Blog</h1>

         <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p>Escrito el <span>20/10/2021</span> por: <span>Gustavo Méndez</span></p>

                    <p>
                        Consejos para construir la terraza en el techo de tu casa con los mejores
                        materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article> <!--.entrada-blog-->

        
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            
            <div class="texto-entrada">
                <a href="entrada2.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p>Escrito el <span>10/05/2021</span> por: <span>Elisa Rodriguez</span></p>

                    <p>
                        Maximiza el espacio en tu hogar con esta guía, aprende a combinar
                        muebles y colores para darle vida a tu espacio
                    </p>
                </a>
            </div>
        </article> <!--.entrada-blog-->

        
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog3.webp" type="image/webp">
                    <source srcset="build/img/blog3.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog3.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            
            <div class="texto-entrada">
                <a href="entrada3.php">
                    <h4>Estudio de Lujo para mayor concentración</h4>
                    <p>Escrito el <span>09/02/2021</span> por: <span>Eduardo Santillán</span></p>

                    <p>
                        Consejos para construir la terraza en el techo de tu casa con los mejores
                        materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article> <!--.entrada-blog-->

        
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog4.webp" type="image/webp">
                    <source srcset="build/img/blog4.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog4.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            
            <div class="texto-entrada">
                <a href="entrada4.php">
                    <h4>Dormitorio amplio para mayor descanso</h4>
                    <p>Escrito el <span>15/07/2021</span> por: <span>Beatriz Dalas</span></p>

                    <p>
                        Maximiza el espacio en tu hogar con esta guía, aprende a combinar
                        muebles y colores para darle vida a tu espacio
                    </p>
                </a>
            </div>
        </article> <!--.entrada-blog-->
    </main>

    <?php includeTemplate("footer"); ?>