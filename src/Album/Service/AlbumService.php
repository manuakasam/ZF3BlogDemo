<?php
namespace Album\Service;

use Album\Mapper\AlbumMapperInterface;

class AlbumService implements AlbumServiceInterface
{
    /**
     * @var \Album\Mapper\AlbumMapperInterface
     */
    protected $albumMapper;

    /**
     * @param AlbumMapperInterface $albumMapper
     */
    public function __construct(AlbumMapperInterface $albumMapper)
    {
        $this->albumMapper = $albumMapper;
    }

    /**
     * @param int|string $id
     * @return \Album\Entity\AlbumInterface
     */
    public function find($id)
    {
        return $this->albumMapper->find($id);
    }

    /**
     * @return array|\Album\Entity\AlbumInterface[]
     */
    public function findAll()
    {
        return $this->albumMapper->findAll();
    }
}