<?php
namespace Album\Controller;

use Album\Entity\AlbumInterface;
use Album\Service\AlbumServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;

class InsertController extends AbstractActionController
{
    protected $albumService;

    protected $albumForm;

    public function __construct(
        AlbumServiceInterface $albumService,
        FormInterface         $albumForm
    ) {
        $this->albumService = $albumService;
        $this->albumForm    = $albumForm;
    }

    public function insertAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return [
                'form' => $this->albumForm
            ];
        }

        $this->albumForm->setData($request->getPost());

        if (!$this->albumForm->isValid()) {
            return [
                'form' => $this->albumForm
            ];
        }

        $album = $this->albumService->save($this->albumForm->getObject());

        if (false === ($album instanceof AlbumInterface)) {
            return [
                'form' => $this->albumForm
            ];
        }

        return $this->redirect()->toRoute('album/details', [
            'id' => $album->getId()
        ]);
    }
} 