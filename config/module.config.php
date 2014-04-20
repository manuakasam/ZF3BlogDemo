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
            'Album\Controller\List'   => 'Album\Factory\ListControllerFactory',
            'Album\Controller\Write'  => 'Album\Factory\WriteControllerFactory',
            'Album\Controller\Delete' => 'Album\Factory\DeleteControllerFactory'
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
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/:id',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                    'add' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'Album\Controller\Write',
                                'action'     => 'add'
                            )
                        )
                    ),
                    'edit' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/edit/:id',
                            'defaults' => array(
                                'controller' => 'Album\Controller\Write',
                                'action'     => 'edit'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                    'delete' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/delete/:id',
                            'defaults' => array(
                                'controller' => 'Album\Controller\Delete',
                                'action'     => 'delete'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                )
            )
        )
    )
);