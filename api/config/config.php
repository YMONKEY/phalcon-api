<?php

return new \Phalcon\Config(array(
    'DIR_INTERFACE' => 'D:/xampp-new/htdocs/project/api/interface/',
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'your host',
        'username'    => 'root',
        'password'    => 'your password',
        'dbname'      => 'your db',
        'charset'     => 'utf8'
    ),
    'application' => array(
        'interfaceDir' => APP_PATH . '/interface/',
        'engineDir'    => APP_PATH . '/engine/',
        'modelsDir'       => APP_PATH . '/models/'
    )
));


?>