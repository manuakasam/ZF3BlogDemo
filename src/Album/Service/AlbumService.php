<?php
// Filename: /module/Album/src/Album/Service/AlbumService.php
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
     * @inheritDoc
     */
    public function findAllAlbums()
    {
        return $this->albumMapper->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findAlbum($id)
    {
        return $this->albumMapper->find($id);
    }
}