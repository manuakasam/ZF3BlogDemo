<?php
// Filename: /module/Blog/src/Blog/Model/BlogInterface.php
namespace Blog\Model;

interface BlogInterface
{
    /**
     * Will return the ID of the Blog
     *
     * @return int
     */
    public function getId();

    /**
     * Will return the TITLE of the Blog
     *
     * @return string
     */
    public function getTitle();

    /**
     * Will return the ARTIST of the Blog
     *
     * @return string
     */
    public function getText();
}