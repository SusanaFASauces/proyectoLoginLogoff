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
                    <header>
                        <h4>Variables superglobales</h4>
                    </header>
                    <?php 
                        /**
                        * @author Susana Fabián Antón
                        * @since 23/11/2020
                        * @version 26/11/2020
                        */
                        
                        session_start();
                        if(!isset($_SESSION[usuarioDAW208LoginLogoffTema5])) { //si el usuario no ha iniciado sesión
                            header('Location: login.php'); //enviamos al usuario de vuelta al login
                        }
                        else { //si ha iniciado sesión correctamente
                            if(!empty($_SESSION)) { //si la variable superglobal está definida 
                    ?>
                    <h5>$_SESSION</h5>
                    <table class="tabla margin">
                        <tr>
                            <th>Variable</th>
                            <th>Valor</th>
                        </tr>
                        <?php
                            if(isset($_SESSION)) {
                                foreach ($_SESSION as $variable => $valor) {
                                    echo "<tr>";
                                    echo "<td>".$variable."</td>";
                                    echo "<td>".$valor."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </table>
                    <?php } if(!empty($_COOKIE)) { //si la variable superglobal está definida ?>
                        <h5>$_COOKIE</h5>
                        <table class="tabla margin">
                            <tr>
                                <th>Variable</th>
                                <th>Valor</th>
                            </tr>
                            <?php
                                if(isset($_COOKIE)) {
                                    foreach ($_COOKIE as $variable => $valor) {
                                        echo "<tr>";
                                        echo "<td>".$variable."</td>";
                                        echo "<td>".$valor."</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </table>
                    <?php } if(!empty($_POST)) { //si la variable superglobal está definida ?> 
                        <h5>$_POST</h5>
                        <table class="tabla margin">
                            <tr>
                                <th>Variable</th>
                                <th>Valor</th>
                            </tr>
                            <?php
                                if(isset($_POST)) {
                                    foreach ($_POST as $variable => $valor) {
                                        echo "<tr>";
                                        echo "<td>".$variable."</td>";
                                        echo "<td>".$valor."</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </table>
                    <?php } if(!empty($_SERVER)) { //si la variable superglobal está definida ?> 
                        <h5>$_SERVER</h5>
                        <table class="tabla margin">
                            <tr>
                                <th>Variable</th>
                                <th>Valor</th>
                            </tr>
                            <?php
                                if(isset($_SERVER)) {
                                    foreach ($_SERVER as $variable => $valor) {
                                        echo "<tr>";
                                        echo "<td>".$variable."</td>";
                                        echo "<td>".$valor."</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </table>
                    <?php } if(!empty($_GET)) { //si la variable superglobal está definida ?> 
                        <h5>$_GET</h5>
                        <table class="tabla margin">
                            <tr>
                                <th>Variable</th>
                                <th>Valor</th>
                            </tr>
                            <?php
                                foreach ($_GET as $variable => $valor) {
                                    echo "<tr>";
                                    echo "<td>".$variable."</td>";
                                    echo "<td>".$valor."</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </table>
                    <?php } if(!empty($_FILES)) { //si la variable superglobal está definida ?>
                        <h5>$_POST</h5>
                        <table class="tabla margin">
                            <tr>
                                <th>Variable</th>
                                <th>Valor</th>
                            </tr>
                            <?php
                                if(isset($_FILES)) {
                                    foreach ($_FILES as $variable => $valor) {
                                        echo "<tr>";
                                        echo "<td>".$variable."</td>";
                                        echo "<td>".$valor."</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </table>
                    <?php } if(!empty($_REQUEST)) { //si la variable superglobal está definida ?>
                        <h5>$_POST</h5>
                        <table class="tabla margin">
                            <tr>
                                <th>Variable</th>
                                <th>Valor</th>
                            </tr>
                            <?php
                                if(isset($_REQUEST)) {
                                    foreach ($_REQUEST as $variable => $valor) {
                                        echo "<tr>";
                                        echo "<td>".$variable."</td>";
                                        echo "<td>".$valor."</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </table>
                    <?php } if(!empty($_ENV)) { //si la variable superglobal está definida ?>
                        <h5>$_POST</h5>
                        <table class="tabla margin">
                            <tr>
                                <th>Variable</th>
                                <th>Valor</th>
                            </tr>
                            <?php
                                if(isset($_ENV)) {
                                    foreach ($_ENV as $variable => $valor) {
                                        echo "<tr>";
                                        echo "<td>".$variable."</td>";
                                        echo "<td>".$valor."</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </table>
                    <?php } ?>
                </article>
                <article>
                    <header>
                        <h4>phpinfo()</h4>
                    </header>
                    <?php
                        phpinfo();}
                    ?>
                </article>
            </section>
        </main>
        <footer>
            <div class="iconos-izq">
                <a href="../proyectoDWES/indexProyectoDWES.html"><img src="../webroot/icons/volver.png" alt="volver"></a>
            </div>
            <address>Contacta conmigo en: susana.fabant@educa.jcyl.es</address>
            <p>- 1 de Diciembre 2020 -</p>
            <div class="iconos-dcha">
                <a href="https://github.com/SusanaFASauces" target="_blank"><img src="../webroot/icons/github.png" alt="github"></a>
            </div>
        </footer>
    </body>
</html>