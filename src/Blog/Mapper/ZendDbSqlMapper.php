<?php
// Filename: /module/Blog/src/Blog/Mapper/ZendDbSqlMapper.php
namespace Blog\Mapper;

use Blog\Model\PostInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ZendDbSqlMapper implements PostMapperInterface
{
    /**
     * @var \Zend\Db\Adapter\AdapterInterface
     */
    protected $dbAdapter;

    /**
     * @var \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator;

    /**
     * @var \Blog\Model\PostInterface
     */
    protected $blogPrototype;

    /**
     * @param AdapterInterface  $dbAdapter
     * @param HydratorInterface $hydrator
     * @param PostInterface    $blogPrototype
     */
    public function __construct(
        AdapterInterface $dbAdapter,
        HydratorInterface $hydrator,
        PostInterface $blogPrototype
    ) {
        $this->dbAdapter      = $dbAdapter;
        $this->hydrator       = $hydrator;
        $this->blogPrototype = $blogPrototype;
    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('blog');
        $select->where(array('id = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->blogPrototype);
        }

        throw new \InvalidArgumentException("Post with given ID:{$id} not found.");
    }

    /**
     * @inheritDoc
     */
    public function findAll()
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('blog');

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->blogPrototype);

            return $resultSet->initialize($result);
        }

        return array();
    }

    /**
     * @inheritDoc
     */
    public function save(PostInterface $blogObject)
    {
        $blogData = $this->hydrator->extract($blogObject);
        unset($blogData['id']); // Neither Insert nor Update needs the ID in the array

        if ($blogObject->getId()) {
            // ID present, it's an Update
            $action = new Update('blog');
            $action->set($blogData);
            $action->where(array('id = ?' => $blogObject->getId()));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('blog');
            $action->values($blogData);
        }

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object
                $blogObject->setId($newId);
            }

            return $blogObject;
        }

        throw new \Exception("Database error");
    }

    /**
     * @inheritDoc
     */
    public function delete(PostInterface $blogObject)
    {
        $action = new Delete('blog');
        $action->where(array('id = ?' => $blogObject->getId()));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }
}