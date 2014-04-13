<?php
namespace Album\Mapper;

use Album\Entity\AlbumInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ZendDbSqlMapper implements AlbumMapperInterface
{
    /**
     * @var \Zend\Db\Adapter\AdapterInterface
     */
    protected $dbAdapter;

    protected $hydrator;

    protected $albumPrototype;

    /**
     * @param AdapterInterface  $dbAdapter
     * @param HydratorInterface $hydrator
     * @param AlbumInterface    $albumPrototype
     */
    public function __construct(
        AdapterInterface $dbAdapter,
        HydratorInterface $hydrator,
        AlbumInterface $albumPrototype
    ) {
        $this->dbAdapter      = $dbAdapter;
        $this->hydrator       = $hydrator;
        $this->albumPrototype = $albumPrototype;
    }

    /**
     * @param int|string $id
     *
     * @return \Album\Entity\AlbumInterface
     * @throws \Exception
     */
    public function find($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('album');

        $select->where->equalTo('id', $id);

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            return $this->hydrator->hydrate($result->current(), $this->albumPrototype);
        }

        throw new \Exception("Album with given ID:{$id} not found.");
    }

    /**
     * @return array|\Album\Entity\AlbumInterface[]
     */
    public function findAll()
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('album');

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->albumPrototype);

            return $resultSet->initialize($result);
        }

        return [];
    }

    /**
     * @param array|\Album\Entity\AlbumInterface $albumArrayOrObject
     *
     * @return \Album\Entity\AlbumInterface
     * @throws \Exception
     */
    public function save($albumArrayOrObject)
    {
        $albumData = $albumArrayOrObject;

        if (is_array($albumArrayOrObject)) {
            $albumData = $this->hydrator->hydrate($albumArrayOrObject, $this->albumPrototype);
        }

        if (is_null($albumData->getId())) {
            $form = $this->getInsertForm();
        } else {
            $form = $this->getUpdateForm();
        }

        $form->bind($albumData);
        if (!$form->isValid()) {
            throw new \Exception("Form data is invalid.");
        }

        // Insert into DB
        // Populate ID Field
        // Return Entity
    }


}