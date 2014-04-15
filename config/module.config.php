<?php
namespace Album;

use Album\Controller\InsertController;
use Album\Controller\InsertControllerFactory;
use Album\Controller\ListController;
use Album\Controller\ListControllerFactory;
use Album\Controller\RemoveController;
use Album\Controller\RemoveControllerFactory;
use Album\Controller\UpdateController;
use Album\Controller\UpdateControllerFactory;
use Album\Form\AlbumFieldset;
use Album\Form\InsertForm;
use Album\Form\RemoveForm;
use Album\Form\UpdateForm;
use Album\Mapper\AlbumMapperInterface;
use Album\Mapper\ZendDbSqlMapperFactory;
use Album\Service\AlbumServiceFactory;
use Album\Service\AlbumServiceInterface;

return [
    'db'              => [
        'driver'         => 'Pdo',
        'username'       => 'root',
        'password'       => 'admin',
        'dsn'            => 'mysql:dbname=album;host=localhost',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ],
    'router'          => [
        'routes' => [
            'album' => [
                'type'          => 'literal',
                'options'       => [
                    'route'    => '/album',
                    'defaults' => [
                        'controller' => ListController::class,
                        'action'     => 'list-all'
                    ]
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'add'     => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'controller' => InsertController::class,
                                'action'     => 'insert'
                            ]
                        ]
                    ],
                    'edit'    => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '/edit/:id',
                            'defaults'    => [
                                'controller' => UpdateController::class,
                                'action'     => 'update'
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ]
                    ],
                    'delete'  => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '/delete/:id',
                            'defaults'    => [
                                'controller' => RemoveController::class,
                                'action'     => 'remove'
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ]
                    ],
                    'details' => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '/view/:id',
                            'defaults'    => [
                                'controller' => ListController::class,
                                'action'     => 'list-single'
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ]
                    ],
                ]
            ]
        ]
    ],
    'controllers'     => [
        'factories' => [
            ListController::class   => ListControllerFactory::class,
            InsertController::class => InsertControllerFactory::class,
            UpdateController::class => UpdateControllerFactory::class,
            RemoveController::class => RemoveControllerFactory::class
        ]
    ],
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter'    => 'Zend\Db\Adapter\AdapterServiceFactory',
            AlbumServiceInterface::class => AlbumServiceFactory::class,
            AlbumMapperInterface::class  => ZendDbSqlMapperFactory::class
        ]
    ],
    'form_elements'   => [
        'invokables' => [
            AlbumFieldset::class => AlbumFieldset::class,
            InsertForm::class    => InsertForm::class,
            UpdateForm::class    => UpdateForm::class,
            RemoveForm::class    => RemoveForm::class
        ]
    ],
    'view_manager'    => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];