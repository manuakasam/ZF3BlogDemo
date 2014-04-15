<?php
namespace Album\Controller;

use Album\Form\InsertForm;
use Album\Service\AlbumServiceInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InsertControllerFactory implements FactoryInterface
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

        return new InsertController(
            $realServiceLocator->get(AlbumServiceInterface::class),
            $realServiceLocator->get('FormElementManager')->get(InsertForm::class)
        );
    }

} 