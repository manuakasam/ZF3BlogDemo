<?php
// Filename: /module/Album/src/Album/Model/AlbumInterface.php
namespace Album\Model;

interface AlbumInterface
{
    /**
     * Will return the ID of the Album
     *
     * @return int
     */
    public function getId();

    /**
     * Will return the TITLE of the Album
     *
     * @return string
     */
    public function getTitle();

    /**
     * Will return the ARTIST of the Album
     *
     * @return string
     */
    public function getArtist();
}