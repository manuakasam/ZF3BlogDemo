<?php
// Filename: /module/Blog/src/Blog/Service/PostService.php
namespace Blog\Service;

use Blog\Mapper\PostMapperInterface;
use Blog\Model\PostInterface;

class PostService implements PostServiceInterface
{
    /**
     * @var \Blog\Mapper\PostMapperInterface
     */
    protected $blogMapper;

    /**
     * @param PostMapperInterface $blogMapper
     */
    public function __construct(PostMapperInterface $blogMapper)
    {
        $this->blogMapper = $blogMapper;
    }

    /**
     * @inheritDoc
     */
    public function findAllPosts()
    {
        return $this->blogMapper->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findPost($id)
    {
        return $this->blogMapper->find($id);
    }

    /**
     * @inheritDoc
     */
    public function savePost(PostInterface $blog)
    {
        return $this->blogMapper->save($blog);
    }

    /**
     * @inheritDoc
     */
    public function deletePost(PostInterface $blog)
    {
        return $this->blogMapper->delete($blog);
    }
}