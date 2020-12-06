<!DOCTYPE html>
<html>
    <head>
        <title>Susana Fabián Antón</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="webroot/css/estilo.css">
    </head>
    <body>
        <header>
            <h1>CFGS Desarrollo de Aplicaciones Web</h1>
            <h2>LoginLogoff</h2>
        </header>
        <main>
            <section>
                <article>
                    <?php
                        /**
                         * PENDIENTE: Añadir mensaje de error, usar hora española, quitar logoff
                         * 
                         * @author Susana Fabián Antón
                         * @since 30/11/2020
                         * @version 03/12/2020
                         */
                        
                        require_once 'config/confDBPDO.php'; //fichero que contiene las constantes de configuración de una base de datos en PDO
                        require_once 'core/201130libreriaValidacion.php'; //librería de validaciones
                        //constantes que contienen datos que necesitan las funciones de la libreria de validacion
                        define('OBLIGATORIO', 1);
                        define('OPCIONAL', 0);
                        $entradaOK = true; // creamos una variable que indicará que el formulario está bien rellenado
                        $aErrores = [ // creamos un array para guardar los errores que surjan durante la validación
                            'usuario' => null,
                            'password' => null
                        ]; 
                        $aFormulario = [ // creamos un array para guardar los valores correctos de los campos del formulario
                            'usuario' => null,
                            'password' => null
                        ];
                  
                        if (isset($_REQUEST['iniciar'])) { // si se ha pulsado enviar
                            // VALIDACIÓN DE LOS DATOS -> utilizando los métodos de la librería de validaciones
                            $aErrores['usuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['usuario'], 100, 1, OBLIGATORIO); // maximo, mínimo y obligatoriedad
                            $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 64, 1, 1, OBLIGATORIO); //máximo, mínimo, tipo y obligatoriedad
                            foreach ($aErrores as $campo => $error) { // recorremos el vector en busca de errores
                                if ($error != null) { // si encontramos errores
                                    $entradaOK = false;
                                }
                            }
                        }
                        else { // si NO se ha pulsado enviar
                            $entradaOK = false;
                        }
                    
                        if ($entradaOK) { // si el formulario se ha rellenado y los datos son correctos
                            // guardamos los datos en el $aFormulario
                            $aFormulario['usuario']=$_POST['usuario'];
                            $aFormulario['password']=$_POST['password'];
                            
                            // TRATAMIENTO DE LOS DATOS
                            try { 
                                $miDB = new PDO(DSN, USER, PASSWORD); //instanciamos un objeto de la clase PDO para conectarnos a la base de datos
                                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //establecemos que cuando se produzca un error en el atributo ERRMODE se lanzará una excepción
                                
                                $selectUsuario = $miDB->query( //buscamos en la base de datos un usuario con esas credenciales
                                    "SELECT T01_CodUsuario, T01_FechaHoraUltimaConexion FROM T01_Usuario ".
                                    "WHERE T01_CodUsuario='$aFormulario[usuario]' AND ".
                                    "T01_Password=SHA2('$aFormulario[usuario]$aFormulario[password]',256)"
                                );
                                if($selectUsuario->rowCount()>0) { //si no se ha encontrado ningún usuario
                                    session_start(); //iniciamos la sesión
                                    $fechaHora = date("Y-m-d H:i:s"); //almacenamos la fecha y la hora actuales en una variable
                                    while($usuario = $selectUsuario->fetch()) { //recorremos los registros de nuestra consulta
                                        $_SESSION[usuarioDAW208LoginLogoffTema5]=$usuario['T01_CodUsuario']; //guardamos en la sesión el nombre del usuario
                                        if($usuario['T01_FechaHoraUltimaConexion']!=null){ //si la ultima conexión está definida
                                            $_SESSION[fechaHoraUltimaConexionAnterior]=$usuario['T01_FechaHoraUltimaConexion']; //guardamos la fecha de la última conexión 
                                        }
                                    }
                                    $updateConexiones = $miDB->exec( //actualizamos la ultima conexión del usuario en la base de datos
                                        "UPDATE T01_Usuario SET T01_FechaHoraUltimaConexion='$fechaHora', T01_NumConexiones=T01_NumConexiones+1 ".
                                        "WHERE T01_CodUsuario='$_SESSION[usuarioDAW208LoginLogoffTema5]'"
                                    );
                                    
                                    if(!isset($_COOKIE[idioma])) {
                                        setcookie('idioma', "es", time()+1722800);
                                    }
                                    header('Location: programa.php'); //enviamos al usuario al programa
                                }
                                else {
                                    header('Location: login.php'); //enviamos al usuario de nuevo al login
                                }
                            }
                            catch(PDOException $ex) { //código a ejecutar cuando se produce un error 
                                echo "<p style='color:red;'>Error en la conexión</p>";
                                echo "<p style=color:red>Error: ".$ex->getMessage()."<br>"; //muestro el mensaje de error
                                echo "Código de error: ".$ex->getCode()."</p>"; //muestro el código del error
                            }
                            finally {
                                unset($miDB); //cerramos la conexion
                            }
                        }
                        else { // si NO se ha pulsado enviar o los datos enviados no son válidos
                            // mostramos el formulario
                    ?>
                    <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <p> <!-- Usuario -->
                            <label for="lblUsuario">Usuario</label>
                            <input type="text" id="lblUsuario" name="usuario" value="<?php
                                if (isset($_POST['usuario']) && $aErrores['usuario']==null) { // si se ha insertado un valor en este campo y no hay nigún error
                                    echo $_POST['usuario']; // mostramos el valor
                                }
                            ?>">
                        </p>
                        <p> <!-- Contraseña -->
                            <label for="lblPassword">Contraseña</label>
                            <input type="password" id="lblPassword" name="password" value="<?php
                                if (isset($_POST['password']) && $aErrores['password']==null) { //si se ha insertado un valor en este campo y no hay nigún error
                                    echo $_POST['password']; // mostramos el valor
                                }
                            ?>">
                        </p>
                        <p>
                            <input type="submit" value="Iniciar sesión" name="iniciar">
                        </p>
                    </form>
                    <?php
                        }
                    ?>
                </article>
            </section>
        </main>
        <footer>
            <div class="iconos-izq">
                <a href="../proyectoDWES/indexProyectoDWES.html"><img src="webroot/icons/volver.png" alt="volver"></a>
            </div>
            <address>Contacta conmigo en: susana.fabant@educa.jcyl.es</address>
            <p>- 3 de Diciembre 2020 -</p>
            <div class="iconos-dcha">
                <a href="https://github.com/SusanaFASauces" target="_blank"><img src="webroot/icons/github.png" alt="github"></a>
            </div>
        </footer>
    </body>
</html>