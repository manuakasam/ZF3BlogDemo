<?php
// Filename: /module/Blog/src/Blog/Service/BlogServiceInterface.php
namespace Blog\Service;

use Blog\Model\BlogInterface;

interface BlogServiceInterface
{
    /**
     * Should return a set of all blogs that we can iterate over. Single entries of the array or \Traversable object
     * should be of type \Blog\Model\Blog
     *
     * @return array|BlogInterface[]
     */
    public function findAllBlogs();

    /**
     * Should return a single blog
     *
     * @param  int $id Identifier of the Blog that should be returned
     * @return BlogInterface
     */
    public function findBlog($id);

    /**
     * Should save a given implementation of the BlogInterface and return it. If it is an existing Blog the Blog
     * should be updated, if it's a new Blog it should be created.
     *
     * @param  BlogInterface $blog
     * @return BlogInterface
     */
    public function saveBlog(BlogInterface $blog);

    /**
     * Should delete a given implementation of the BlogInterface and return true if the deletion has been
     * successful or false if not.
     *
     * @param  BlogInterface $blog
     * @return bool
     */
    public function deleteBlog(BlogInterface $blog);
}