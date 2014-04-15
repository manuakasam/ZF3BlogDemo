<?php
namespace Album\Mapper;

use Album\Entity\AlbumInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

interface AlbumMapperInterface
{
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
     * @return AlbumInterface
     * @throws \Exception
     */
    public function save(AlbumInterface $albumObject);

    /**
     * @param AlbumInterface $albumObject
     *
     * @return bool
     * @throws \Exception
     */
    public function remove(AlbumInterface $albumObject);
} 