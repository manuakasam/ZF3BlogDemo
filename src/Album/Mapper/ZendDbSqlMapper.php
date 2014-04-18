<?php
// Filename: /module/Album/src/Album/Mapper/ZendDbSqlMapper.php
namespace Album\Mapper;

use Album\Model\AlbumInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
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
     * @return AlbumInterface
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('album');
        $select->where(array('id = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->albumPrototype);
        }

        throw new \InvalidArgumentException("Album with given ID:{$id} not found.");
    }

    /**
     * @return array|AlbumInterface[]
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

        return array();
    }

    /**
     * @param AlbumInterface $albumObject
     *
     * @return AlbumInterface
     * @throws \Exception
     */
    public function save(AlbumInterface $albumObject)
    {
        $albumData = $this->hydrator->extract($albumObject);
        unset($albumData['id']); // Neither Insert nor Update needs the ID in the array

        if ($albumObject->getId()) {
            // ID present, it's an Update
            $action = new Update('album');
            $action->set($albumData);
            $action->where(array('id = ?' => $albumObject->getId()));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('album');
            $action->values($albumData);
        }

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object
                $albumObject->setId($newId);
            }

            return $albumObject;
        }

        throw new \Exception("Database error");
    }
}