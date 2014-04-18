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
     * @return AlbumInterface
     * @throws \Exception
     */
    protected function insert(AlbumInterface $albumObject)
    {
        \Zend\Debug\Debug::dump($this->hydrator->extract($albumObject));die("test");
        $action = new Insert('album');
        $action->values($this->hydrator->extract($albumObject));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $albumObject->setId($result->getGeneratedValue());

            return $albumObject;
        }

        throw new \Exception("Album couldn't be added.");
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
        $action->where(array('id = ?' => $albumObject->getId()));

        $sql  = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);

        $stmt->execute();

        return $albumObject;
    }
}