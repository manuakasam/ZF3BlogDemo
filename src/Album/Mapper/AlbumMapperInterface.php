<?php
// Filename: /module/Album/src/Album/Mapper/AlbumMapperInterface.php
namespace Album\Mapper;

use Album\Model\AlbumInterface;

interface AlbumMapperInterface
{
    /**
     * @param int|string $id
     * @return AlbumInterface
     * @throws \InvalidArgumentException
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
//    public function remove(AlbumInterface $albumObject);
}