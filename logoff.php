<?php
    /**
    * @author Susana Fabián Antón
    * @since 01/12/2020
    * @version 02/12/2020
    */
    session_start();
    session_destroy();
    header('Location: login.php'); //enviamos al usuario de vuelta al login
