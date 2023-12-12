<?php

function autoload($class)
{
    $file = $class . ".php";
    // echo $file;
    if (is_readable($file)) {
        require($file);
    }
}
spl_autoload_register('autoload');