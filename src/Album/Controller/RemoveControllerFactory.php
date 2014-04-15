<?php
namespace Album\Controller;

use Album\Form\RemoveForm;
use Album\Service\AlbumServiceInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RemoveControllerFactory implements FactoryInterface
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

        return new RemoveController(
            $realServiceLocator->get(AlbumServiceInterface::class),
            $realServiceLocator->get('FormElementManager')->get(RemoveForm::class)
        );
    }
} 