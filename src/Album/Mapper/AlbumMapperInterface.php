<?php
namespace Album\Mapper;

use Album\Entity\AlbumInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

interface AlbumMapperInterface
{
    /**
     * @return HydratorInterface
     */
    public function getHydrator();

    /**
     * @return AlbumInterface
     */
    public function getAlbumPrototype();

    /**
     * @param int|string $id
     * @return AlbumInterface
     */
    public function find($id);

    /**
     * @return array|AlbumInterface[]
     */
    public function findAll();

    /**
     * @param AlbumInterface $albumObject
     *
     * @param AlbumInterface $albumObject
     * @return mixed
     * @throws \Exception
     */
    public function save(AlbumInterface $albumObject);
} 