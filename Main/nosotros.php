<?php
    require "includes/funciones.php";
    includeTemplate("header");
    ?>
     
    <main class="contenedor seccion">

        <h1>Conoce Sobre Nosotros</h1> 
            <div class="contenido-nosotros">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/nosotros.webp" type="image/webp">
                        <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros"> 
                    </picture>
                </div>
                <div class="texto-nosotros">
                        <blockquote>
                            25 Años de Experiencia
                        </blockquote> 
                        <p>Morbi pretium elit eu augue auctor, sed mollis massa laoreet. Nunc convallis 
                        dui vitae eleifend sollicitudin. Vivamus fringilla erat quis lacus facilisis, 
                        vitae sagittis ligula sagittis. Sed tempor lorem eu ipsum interdum luctus. 
                        Vivamus aliquam ac elit nec suscipit. Duis vitae libero quis ligula semper malesuada. </p>

                        <p>Consectetur adipiscing elit. Vivamus ipsum turpis, molestie a leo ac, pretium 
                        fermentum turpis. Curabitur lectus ex, dignissim non justo quis, imperdiet dapibus quam.</p>
                </div>
            </div>

        <section class="contenedor seccion">
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
        </section>
    </main>


    <?php includeTemplate("footer"); ?>