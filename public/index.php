<?php

    require realpath( __DIR__ . "/.." . '/src/autoload.php' );

    new \LegendsGame\Router(
        $_SERVER['HTTP_HOST'],
        $_SERVER['REQUEST_METHOD'],
        $_SERVER['REQUEST_URI']
    );

?>