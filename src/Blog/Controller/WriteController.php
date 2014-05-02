<?php
// Filename: /module/Blog/src/Blog/Controller/WriteController.php
namespace Blog\Controller;

use Blog\Service\BlogServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    protected $blogService;

    protected $blogForm;

    public function __construct(
        BlogServiceInterface $blogService,
        FormInterface $blogForm
    ) {
        $this->blogService = $blogService;
        $this->blogForm    = $blogForm;
    }

    public function addAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->blogForm->setData($request->getPost());

            if ($this->blogForm->isValid()) {
                try {
                    $this->blogService->saveBlog($this->blogForm->getData());

                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->blogForm
        ));
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $blog   = $this->blogService->findBlog($this->params('id'));

        $this->blogForm->bind($blog);

        if ($request->isPost()) {
            $this->blogForm->setData($request->getPost());

            if ($this->blogForm->isValid()) {
                try {
                    $this->blogService->saveBlog($blog);

                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->blogForm
        ));
    }
}