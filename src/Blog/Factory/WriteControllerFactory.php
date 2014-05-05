<?php
// Filename: /module/Blog/src/Blog/Factory/WriteControllerFactory.php
namespace Blog\Factory;

use Blog\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WriteControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $blogService       = $realServiceLocator->get('Blog\Service\PostServiceInterface');
        $blogInsertForm    = $realServiceLocator->get('FormElementManager')->get('Blog\Form\PostForm');

        return new WriteController(
            $blogService,
            $blogInsertForm
        );
    }
}