<?php
namespace Album\Entity;

interface AlbumInterface
{
    /**
     * @param $id
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @return mixed
     */
    public function getArtist();
}