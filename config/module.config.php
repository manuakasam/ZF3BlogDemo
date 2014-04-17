<?php
// Filename: /module/Album/config/module.config.php
return array(
    'db' => array(
        'driver'         => 'Pdo',
        'username'       => 'root',
        'password'       => 'admin',
        'dsn'            => 'mysql:dbname=album;host=localhost',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Album\Mapper\AlbumMapperInterface'   => 'Album\Factory\ZendDbSqlMapperFactory',
            'Album\Service\AlbumServiceInterface' => 'Album\Factory\AlbumServiceFactory',
            'Zend\Db\Adapter\Adapter'             => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Album\Controller\List' => 'Album\Factory\ListControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'album' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/album',
                    'defaults' => array(
                        'controller' => 'Album\Controller\List',
                        'action'     => 'index',
                    )
                )
            )
        )
    )
);