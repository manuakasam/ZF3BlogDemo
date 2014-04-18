<?php
// Filename: /module/Album/src/Album/Factory/WriteControllerFactory.php
namespace Album\Factory;

use Album\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WriteControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $albumService       = $realServiceLocator->get('Album\Service\AlbumServiceInterface');
        $albumInsertForm    = $realServiceLocator->get('FormElementManager')->get('Album\Form\AlbumForm');

        return new WriteController(
            $albumService,
            $albumInsertForm
        );
    }
}