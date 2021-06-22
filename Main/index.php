<?php
    declare(strict_types=1);
    require "includes/funciones.php";
    includeTemplate("header", $inicio = true);
    ?>

    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="iconos">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Nunc interdum lorem et felis consectetur rutrum. Maecenas ultrices,
                mauris vel malesuada venenatis, nisl ex facilisis augue, et pulvinar
                turpis diam eget neque. Quisque ornare elit et ultricies convallis.</p>
            </div> 
            <div class="iconos">
              <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
              <h3>Precio</h3>
              <p>Nunc interdum lorem et felis consectetur rutrum. Maecenas ultrices,
               mauris vel malesuada venenatis, nisl ex facilisis augue, et pulvinar
               turpis diam eget neque. Quisque ornare elit et ultricies convallis.</p>
            </div> 
            <div class="iconos">
              <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
              <h3>A Tiempo</h3>
              <p>Nunc interdum lorem et felis consectetur rutrum. Maecenas ultrices,
               mauris vel malesuada venenatis, nisl ex facilisis augue, et pulvinar
               turpis diam eget neque. Quisque ornare elit et ultricies convallis.</p>
            </div>   
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php 
            $limite = 3;
            include "includes/templates/anuncios.php";  
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la Casa de tus Sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

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
                        <p class="informacion-meta">Escrito el <span>20/10/2021</span> por: <span>Gustavo Méndez</span></p>

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
                        <p class="informacion-meta">Escrito el <span>10/05/2021</span> por: <span>Elisa Rodriguez</span></p>

                        <p>
                            Maximiza el espacio en tu hogar con esta guía, aprende a combinar
                            muebles y colores para darle vida a tu espacio
                        </p>
                    </a>
                </div>
            </article> <!--.entrada-blog-->
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa 
                    que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Alan Martínez</p>
            </div>
        </section>
    </div>

    <?php includeTemplate("footer"); ?>