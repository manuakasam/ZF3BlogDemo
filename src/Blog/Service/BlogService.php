<?php
// Filename: /module/Blog/src/Blog/Service/BlogService.php
namespace Blog\Service;

use Blog\Mapper\BlogMapperInterface;
use Blog\Model\BlogInterface;

class BlogService implements BlogServiceInterface
{
    /**
     * @var \Blog\Mapper\BlogMapperInterface
     */
    protected $blogMapper;

    /**
     * @param BlogMapperInterface $blogMapper
     */
    public function __construct(BlogMapperInterface $blogMapper)
    {
        $this->blogMapper = $blogMapper;
    }

    /**
     * @inheritDoc
     */
    public function findAllBlogs()
    {
        return $this->blogMapper->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findBlog($id)
    {
        return $this->blogMapper->find($id);
    }

    /**
     * @inheritDoc
     */
    public function saveBlog(BlogInterface $blog)
    {
        return $this->blogMapper->save($blog);
    }

    /**
     * @inheritDoc
     */
    public function deleteBlog(BlogInterface $blog)
    {
        return $this->blogMapper->delete($blog);
    }
}