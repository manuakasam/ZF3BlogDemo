<?php
// Filename: /module/Blog/src/Blog/Factory/ListControllerFactory.php
namespace Blog\Factory;

use Blog\Controller\ListController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $blogService       = $realServiceLocator->get('Blog\Service\BlogServiceInterface');

        return new ListController($blogService);
    }
}