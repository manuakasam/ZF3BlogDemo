<?php
namespace Album\Service;

use Album\Entity\AlbumInterface;
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

    /**
     * @param AlbumInterface $albumObject
     *
     * @return AlbumInterface
     * @throws \Exception
     */
    public function save(AlbumInterface $albumObject)
    {
        // possibly add event triggers here to trigger more business logic BEFORE an album is saved

        $result = $this->albumMapper->save($albumObject);

        // possibly add event triggers here to trigger more business logic AFTER an album has been saved

        return $result;
    }


}