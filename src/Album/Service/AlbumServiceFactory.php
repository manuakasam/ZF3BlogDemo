<?php
namespace Album\Service;

use Album\Mapper\AlbumMapperInterface;
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
            $serviceLocator->get(AlbumMapperInterface::class)
        );
    }
}