<?php
namespace Album\Mapper;

interface AlbumMapperInterface
{
    /**
     * @param int|string $id
     * @return \Album\Entity\AlbumInterface
     */
    public function find($id);

    /**
     * @return array|\Album\Entity\AlbumInterface[]
     */
    public function findAll();

    /**
     * @param array|\Album\Entity\AlbumInterface $albumArrayOrObject
     *
     * @return \Album\Entity\AlbumInterface
     * @throws \Exception
     */
    public function save($albumArrayOrObject);
} 