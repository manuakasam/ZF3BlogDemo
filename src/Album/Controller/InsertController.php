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

        if ($request->isPost()) {
            $this->albumForm->setData($request->getPost());

            if ($this->albumForm->isValid()) {
                try {
                    $newAlbum = $this->albumService->save($this->albumForm->getObject());
                } catch (\Exception $e) {
                    //@todo Some error happened, log it
                }

                return $this->redirect()->toRoute('album/details', [
                    'id' => $newAlbum->getId()
                ]);
            }
        }

        return [
            'form' => $this->albumForm
        ];
    }
} 