<?php
namespace Album\Controller;

use Album\Service\AlbumServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
    /**
     * @var \Album\Service\AlbumServiceInterface
     */
    protected $albumService;

    public function __construct(AlbumServiceInterface $albumService)
    {
        $this->albumService = $albumService;
    }

    public function deleteAction()
    {
        try {
            $album = $this->albumService->findAlbum($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation');

            if ($del === 'yes') {
                $this->albumService->deleteAlbum($album);
            }

            return $this->redirect()->toRoute('album');
        }

        return new ViewModel(array(
            'album' => $album
        ));
    }
} 