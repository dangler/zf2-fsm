<?php
namespace JydFsm;

return array(
    'controllers' => array(
        'invokables' => array(
            'JydFsm\Controller\Index' => 'JydFsm\Controller\IndexController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/fsm[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'JydFsm\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'fsm' => __DIR__ . '/../view',
        )
    ),

    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            'JydFsm_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/JydFsm/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'JydFsm\Entity' => 'JydFsm_driver'
                )
            )
        )
    )
);