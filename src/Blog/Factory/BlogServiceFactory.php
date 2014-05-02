<?php
// Filename: /module/Blog/src/Blog/Factory/BlogServiceFactory.php
namespace Blog\Factory;

use Blog\Service\BlogService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlogServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new BlogService(
            $serviceLocator->get('Blog\Mapper\BlogMapperInterface')
        );
    }
}