<?php
// Filename: /module/Album/src/Album/Service/AlbumServiceInterface.php
namespace Album\Service;

use Album\Model\AlbumInterface;

interface AlbumServiceInterface
{
    /**
     * Should return a set of all albums that we can iterate over. Single entries of the array or \Traversable object
     * should be of type \Album\Model\Album
     *
     * @return array|AlbumInterface[]
     */
    public function findAllAlbums();

    /**
     * Should return a single album
     *
     * @param  int $id Identifier of the Album that should be returned
     * @return AlbumInterface
     */
    public function findAlbum($id);

    /**
     * Should save a given implementation of the AlbumInterface and return it. If it is an existing Album the Album
     * should be updated, if it's a new Album it should be created.
     *
     * @param  AlbumInterface $album
     * @return AlbumInterface
     */
    public function saveAlbum(AlbumInterface $album);

    /**
     * Should delete a given implementation of the AlbumInterface and return true if the deletion has been
     * successful or false if not.
     *
     * @param  AlbumInterface $album
     * @return bool
     */
    public function deleteAlbum(AlbumInterface $album);
}