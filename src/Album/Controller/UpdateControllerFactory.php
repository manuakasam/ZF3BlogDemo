<?php
namespace Album\Controller;

use Album\Form\UpdateForm;
use Album\Service\AlbumServiceInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UpdateControllerFactory implements FactoryInterface
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

        return new UpdateController(
            $realServiceLocator->get(AlbumServiceInterface::class),
            $realServiceLocator->get('FormElementManager')->get(UpdateForm::class)
        );
    }
} 