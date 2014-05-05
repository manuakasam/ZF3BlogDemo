<?php
// Filename: /module/Blog/src/Blog/Controller/DeleteController.php
namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
    /**
     * @var \Blog\Service\PostServiceInterface
     */
    protected $blogService;

    public function __construct(PostServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    public function deleteAction()
    {
        try {
            $blog = $this->blogService->findPost($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('blog');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation');

            if ($del === 'yes') {
                $this->blogService->deletePost($blog);
            }

            return $this->redirect()->toRoute('blog');
        }

        return new ViewModel(array(
            'blog' => $blog
        ));
    }
} 