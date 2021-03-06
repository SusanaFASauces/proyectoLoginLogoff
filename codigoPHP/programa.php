<?php
    /**
     * @author Susana Fabián Antón
     * @since 30/11/2020
     * @version 13/12/2020
     */

    session_start(); //recuperamos la información de la sesión
    if(!isset($_SESSION[usuarioDAW208LoginLogoffTema5])) { //si el usuario no ha iniciado sesión
        header('Location: login.php'); //enviamos al usuario de vuelta al login
        exit;
    }
    if(isset($_REQUEST["idiomaSelect"])) { //si se ha seleccionado un idioma
        setcookie("idioma", $_REQUEST["idiomaSelect"], time()+172800); //establecemos la cookie con el idioma correspondiente
        header("Location: programa.php"); //recargamos la página
        exit;
    }
    if (isset($_REQUEST['cerrarSesion'])) { // si se ha pulsado el botón de cerrar sesión
        session_destroy(); //destruimos la sesión
        header('Location: login.php'); //enviamos al usuario de vuelta al login
        exit;
    }
?>  
<!DOCTYPE html>
<html>
    <head>
        <title>Susana Fabián Antón</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../webroot/css/estilo.css">
    </head>
    <body>
        <header>
            <h1>CFGS Desarrollo de Aplicaciones Web</h1>
            <h2>LoginLogoff</h2>
        </header>
        <main>
            <section>
                <article>
                    <div class="sesion">
                        <?php
                            require_once '../config/confDBPDO.php'; //fichero que contiene las constantes de configuración de una base de datos en PDO

                            try {
                                $miDB = new PDO(DSN, USER, PASSWORD); //instanciamos un objeto de la clase PDO para conectarnos a la base de datos
                                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //establecemos que cuando se produzca un error en el atributo ERRMODE se lanzará una excepción

                                $selectUsuario = $miDB->query( //buscamos en la base de datos la descripción del usuario y su número de conexiones
                                    "SELECT T01_DescUsuario, T01_NumConexiones FROM T01_Usuario ".
                                    "WHERE T01_CodUsuario='$_SESSION[usuarioDAW208LoginLogoffTema5]'"    
                                );
                                while($usuario = $selectUsuario->fetch()) { //recorremos los registros de nuestra consulta
                                    if($_COOKIE[idioma]=="es") {
                                        echo "<p class=center style=font-size:1.2em>¡Bienvenido $usuario[T01_DescUsuario]!</p>"; //mostramos un mensaje de bienvenida
                                    }
                                    if($_COOKIE[idioma]=="en") {
                                        echo "<p class=center style=font-size:1.2em>Welcome $usuario[T01_DescUsuario]!</p>"; //mostramos un mensaje de bienvenida
                                    }
                                    $numConexiones = $usuario[T01_NumConexiones];
                                }
                                if($numConexiones>1) { //si el usuario se ha conectado alguna vez a la aplicación
                                    echo "<p>Te has conectado por última vez el $_SESSION[fechaHoraUltimaConexionAnterior]</p>"; //mostramos la fecha y la hora de su última conexión
                                    echo "<p>Esta es tu ".$numConexiones."ª conexión.</p>"; //mostramos el número de conexiones del usuario
                                }
                                else { //si es la primera vez que se conecta
                                    echo "<p>Esta es la primera vez que te conectas.</p>"; //mostramos un mensaje indicándolo
                                }
                        ?>
                        <form name="formularioIdioma" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <p> <!-- Idioma -->
                                <label for="lblIdioma">Introduzca el idioma de su preferencia: </label>
                                <select name="idiomaSelect" id="lblIdioma" onchange="this.form.submit()">
                                    <option value="es" <?php if($_COOKIE[idioma]=="es"){echo "selected";}?>>Español</option>
                                    <option value="en" <?php if($_COOKIE[idioma]=="en"){echo "selected";}?>>Inglés</option>
                                </select>
                            </p>
                        </form>  
                        <div class="botones-sesion">
                            <!--<a href=editarPerfil.php>Editar Perfil</a>-->
                            <a href=detalle.php>Detalles</a>
                            <form class="inline-block" name="logoff" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="submit" value="Cerrar sesión" name="cerrarSesion">
                            </form>
                        </div>
                        <?php
                            }
                            catch(PDOException $ex) { //código a ejecutar cuando se produce un error 
                                echo "<p style='color:red;'>Error en la conexión</p>";
                                echo "<p style=color:red>Error: ".$ex->getMessage()."<br>"; //muestro el mensaje de error
                                echo "Código de error: ".$ex->getCode()."</p>"; //muestro el código del error
                            }
                            finally {
                                unset($miDB); //cerramos la conexion
                            }
                        ?> 
                    </div>
                </article>
            </section>
        </main>
        <footer>
            <div class="iconos-izq">
                <a href="../../proyectoDWES/indexProyectoDWES.html"><img src="../webroot/icons/volver.png" alt="volver"></a>
            </div>
            <address>Contacta conmigo en: susana.fabant@educa.jcyl.es</address>
            <p>- 13 de Diciembre 2020 -</p>
            <div class="iconos-dcha">
                <a href="https://github.com/SusanaFASauces" target="_blank"><img src="../webroot/icons/github.png" alt="github"></a>
            </div>
        </footer>
    </body>
</html>

