<?php
    require "includes/config/database.php";
    $db = conectarDB();
    //Autenticar el usuario

    $errores = [];

    //se ejecuta este codigo, una vez que enviamos este formulario (method POST)
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // echo "<pre>"; //para obtener arreglo formateado(separados en linea vertical)
        // var_dump($_POST);
        // echo "</pre>";

        //como email interactua con la base de datos lleva el real escape
        $email = mysqli_real_escape_string($db,filter_var ($_POST["email"], FILTER_VALIDATE_EMAIL)); // validamos mail pero en frontend
        $password = mysqli_real_escape_string($db,$_POST["password"] );

        if(!$email){
            $errores[] = "El email es obligatorio o no es valido";
        }   

        if(!$password){
            $errores[] = "El password es obligatorio";
        }   

        //en caso que las validaciones esten vacias
        if(empty($errores)){
            //revisar si el usuario existe

            $query = " SELECT * FROM usuarios WHERE email = '${email}'";
            //leemos los resultados de la consulta(query)
            $resultado = mysqli_query($db, $query);
            
            
            if($resultado->num_rows){
                //revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario["password"]);

                if($auth){
                    //El usuario es autenticado
                    session_start();

                    //Llenar el arreglo de la sesión
                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION["login"] = true; // el login es lo importante 

                    header("Location: /admin");

                }
                else{
                    $errores[] = "El password es incorrecto";
                }
                
            }
            else{
                $errores[] = "El usuario no existe";
            }
        }
    }
    //Incluye el headear
    require "includes/funciones.php";
    includeTemplate("header");
    ?>
    
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" require>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password" require>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

    
    <?php 
    //incluye el footer
    includeTemplate("footer"); 
    ?>