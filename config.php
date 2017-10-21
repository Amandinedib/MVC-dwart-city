<?php


define('CLASS_PATH', 'classes');
define('CONTROLLERS_PATH', 'Controllers');
define('MODELS_PATH', 'Models');
define('VIEWS_PATH', 'Views');

define('DB_HOST', 'localhost');
define('DB_NAME', 'gurdil');
define('DB_USER', 'root');
define('DB_PASS', '');

define('MESSAGES_PER_PAGE', 15);
define('APP_SESSION', 'forum');

define('DS', DIRECTORY_SEPARATOR);

spl_autoload_register(function($class)
{
    $folder = CLASS_PATH;
    if(strpos($class, 'Controller') !== false)
    {
        $folder = CONTROLLERS_PATH;
    }
    elseif (strpos($class, 'Model') !== false)
    {
        $folder = MODELS_PATH;
    }

    $filename = '.' . DS . $folder . DS . $class . '.php';
    if(file_exists($filename))
    {
        include($filename);
    }
});