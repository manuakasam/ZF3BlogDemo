<?php
namespace Album\Controller;

use Album\Service\AlbumServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;

class UpdateController extends AbstractActionController
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

    public function updateAction()
    {
        $request = $this->getRequest();
        $albumId = $this->params('id');

        try {
            $albumObject = $this->albumService->find($albumId);
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage($e->getMessage());

            return $this->redirect()->toRoute('album');
        }

        $this->albumForm->bind($albumObject);

        if ($request->isPost()) {
            $this->albumForm->setData($request->getPost());

            if ($this->albumForm->isValid()) {
                try {
                    $this->albumService->save($album = $this->albumForm->getObject());
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

                return $this->redirect()->toRoute('album/details', [
                    'id' => $album->getId()
                ]);
            }
        }

        return [
            'form' => $this->albumForm
        ];
    }
} 