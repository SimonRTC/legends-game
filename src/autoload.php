<?php

    $path = realpath( __DIR__ . "/.." );
    $path = ($path !== false? $path: null);

    define("__PATH__", $path);
    define("__DATE_FORMAT__", "Y-d-m\TG:i:s.u\ZP");
    define("__DATE_TIMEZONE__", "Europe/Paris");

    if (SESSION_ID() == NULL) {
        SESSION_START();
    }

    require __PATH__ . '/vendor/autoload.php';

?>