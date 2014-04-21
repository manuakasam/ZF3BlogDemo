<?php
// Filename: /module/Album/src/Album/Controller/WriteController.php
namespace Album\Controller;

use Album\Service\AlbumServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    protected $albumService;

    protected $albumForm;

    public function __construct(
        AlbumServiceInterface $albumService,
        FormInterface $albumForm
    ) {
        $this->albumService = $albumService;
        $this->albumForm    = $albumForm;
    }

    public function addAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->albumForm->setData($request->getPost());

            if ($this->albumForm->isValid()) {
                try {
                    $this->albumService->saveAlbum($this->albumForm->getData());

                    return $this->redirect()->toRoute('album');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->albumForm
        ));
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $album   = $this->albumService->findAlbum($this->params('id'));

        $this->albumForm->bind($album);

        if ($request->isPost()) {
            $this->albumForm->setData($request->getPost());

            if ($this->albumForm->isValid()) {
                try {
                    $this->albumService->saveAlbum($album);

                    return $this->redirect()->toRoute('album');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->albumForm
        ));
    }
}