<?php
namespace Album\Controller;

use Album\Service\AlbumServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;

class RemoveController extends AbstractActionController
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

    public function removeAction()
    {
        $request = $this->getRequest();
        $albumId = $this->params('id');

        try {
            $albumObject = $this->albumService->find($albumId);
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage($e->getMessage());

            return $this->redirect()->toRoute('album');
        }

        if ($request->isPost()) {
            $this->albumForm->setData($request->getPost());

            if ($this->albumForm->isValid()) {
                try {
                    $this->albumService->remove($albumObject);
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

                return $this->redirect()->toRoute('album');
            }
        }

        return [
            'form'  => $this->albumForm,
            'album' => $albumObject
        ];
    }
} 