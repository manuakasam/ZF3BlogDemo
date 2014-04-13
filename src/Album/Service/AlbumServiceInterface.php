<?php
namespace Album\Service;

use Album\Entity\AlbumInterface;

interface AlbumServiceInterface
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
     * @param array|AlbumInterface $albumObjectOrArray
     * @return AlbumInterface
     * @throws \Exception
     */
    public function save($albumObjectOrArray);
} 