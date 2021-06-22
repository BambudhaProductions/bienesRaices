<?php
    require "includes/funciones.php";
    includeTemplate("header");
    ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Dormitorio amplio para mayor descanso</h1>

        <picture>
            <source srcset="build/img/blog4.webp" type="image webp">
            <source srcset="build/img/blog4.jpg" type="image jepg"> 
            <img loading="lazy" src="build/img/blog4.jpg" alt="imagen de la propiedad">  
        </picture>

        <p class="informacion-meta">Escrito el: <span>15/07/2021</span> por: <span>Beatriz Dalas</span> </p>

        <div class="resumen-propiedad">
            <p>Nulla facilisi. Nunc ut enim sem. Donec eu eleifend nunc. Mauris luctus quis urna eu fringilla.
             Suspendisse ornare congue erat sed mattis. Nullam metus nisl, feugiat ut sagittis quis, mattis feugiat sem. 
             Integer tincidunt ex quis convallis varius. Nullam in dapibus ligula, id aliquam felis. Curabitur at rutrum sapien. </p>
            <p>Phasellus sollicitudin rhoncus sollicitudin. Mauris eu congue sapien, id rhoncus lacus. Quisque porta ornare tincidunt.
            Sed ornare eu magna eget malesuada. Etiam a massa vitae diam fringilla elementum non vitae quam. Proin sagittis 
            volutpat erat, ut malesuada quam elementum consequat. Nunc id erat ut tortor condimentum facilisis. Sed euismod 
            urna vel accumsan tempor. Nulla ac volutpat dui, eu luctus ligula. Proin vitae varius tellus. Donec eu sapien non 
            nibh vehicula dapibus pulvinar et nulla. Vivamus felis neque, posuere vel velit vitae, porta fermentum sapien.</p>
        </div>
    </main>

    <?php includeTemplate("footer"); ?>