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
     * @param array|AlbumInterface $albumObjectOrArray
     *
     * @return AlbumInterface
     * @throws \Exception
     */
    public function save($albumObjectOrArray)
    {
        if (is_array($albumObjectOrArray)) {
            $albumData = $this->albumMapper->getHydrator()->hydrate(
                $albumObjectOrArray,
                $this->albumMapper->getAlbumPrototype()
            );
        } else {
            $albumData = $albumObjectOrArray;
        }

        if (null === $albumData->getId()) {
            $form = $this->getInsertForm();
        } else {
            $form = $this->getUpdateForm();
        }

        $form->bind($albumData);

        if (!$form->isValid()) {
            throw new \Exception('Data is invalid');
        }

        return $this->albumMapper->save($albumData);
    }


}