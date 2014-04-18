<?php
// Filename: /module/Album/src/Album/Controller/ListController.php
namespace Album\Controller;

use Album\Service\AlbumServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{
    /**
     * @var \Album\Service\AlbumServiceInterface
     */
    protected $albumService;

    public function __construct(AlbumServiceInterface $albumService)
    {
        $this->albumService = $albumService;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->albumService->findAllAlbums()
        ));
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');

        try {
            $album = $this->albumService->findAlbum($id);
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('album');
        }

        return new ViewModel(array(
            'album' => $album
        ));
    }
}