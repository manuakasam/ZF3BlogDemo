<?php
namespace Album\Controller;

use Album\Service\AlbumServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;

class ListController extends AbstractActionController
{
    /**
     * @var \Album\Service\AlbumServiceInterface
     */
    protected $albumService;

    /**
     * @param AlbumServiceInterface $albumService
     */
    public function __construct(AlbumServiceInterface $albumService)
    {
        $this->albumService = $albumService;
    }

    public function listAllAction()
    {
        return [
            'albumCollection' => $this->albumService->findAll()
        ];
    }

    public function listSingleAction()
    {
        return [
            'album' => $this->albumService->find($this->params('id'))
        ];
    }
} 