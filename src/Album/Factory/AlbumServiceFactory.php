<?php
// Filename: /module/Album/src/Album/Factory/AlbumServiceFactory.php
namespace Album\Factory;

use Album\Service\AlbumService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AlbumServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AlbumService(
            $serviceLocator->get('Album\Mapper\AlbumMapperInterface')
        );
    }
}