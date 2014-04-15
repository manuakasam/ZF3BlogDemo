<?php
namespace Album\Mapper;

use Album\Entity\AlbumInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
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
     * @param AlbumInterface $albumObject
     *
     * @return mixed
     * @throws \Exception
     */
    public function save(AlbumInterface $albumObject)
    {
        if ($albumObject->getId()) {
            return $this->update($albumObject);
        }

        return $this->insert($albumObject);
    }

    /**
     * @param AlbumInterface $albumObject
     *
     * @return bool
     * @throws \Exception
     */
    public function remove(AlbumInterface $albumObject)
    {
        $action = new Delete('album');
        $action->where->equalTo('id', $albumObject->getId());

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }


    /**
     * @param AlbumInterface $albumObject
     *
     * @return AlbumInterface
     */
    protected function insert(AlbumInterface $albumObject)
    {
        $action = new Insert('album');
        $action->values($this->hydrator->extract($albumObject));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        $albumObject->setId($result->getGeneratedValue());

        return $albumObject;
    }

    /**
     * @param AlbumInterface $albumObject
     *
     * @return AlbumInterface
     */
    protected function update(AlbumInterface $albumObject)
    {
        $albumData = $this->hydrator->extract($albumObject);
        unset($albumData['id']);

        $action = new Update('album');
        $action->set($albumData);
        $action->where->equalTo('id', $albumObject->getId());

        $sql  = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);

        $stmt->execute();

        return $albumObject;
    }
}