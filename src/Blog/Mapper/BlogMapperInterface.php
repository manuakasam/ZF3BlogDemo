<?php
// Filename: /module/Blog/src/Blog/Mapper/BlogMapperInterface.php
namespace Blog\Mapper;

use Blog\Model\BlogInterface;

interface BlogMapperInterface
{
    /**
     * @param int|string $id
     * @return BlogInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);

    /**
     * @return array|BlogInterface[]
     */
    public function findAll();

    /**
     * @param BlogInterface $blogObject
     *
     * @param BlogInterface $blogObject
     * @return BlogInterface
     * @throws \Exception
     */
    public function save(BlogInterface $blogObject);

    /**
     * @param BlogInterface $blogObject
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(BlogInterface $blogObject);
}