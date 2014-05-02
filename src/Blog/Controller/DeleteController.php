<?php
namespace Blog\Controller;

use Blog\Service\BlogServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
    /**
     * @var \Blog\Service\BlogServiceInterface
     */
    protected $blogService;

    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    public function deleteAction()
    {
        try {
            $blog = $this->blogService->findBlog($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('blog');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation');

            if ($del === 'yes') {
                $this->blogService->deleteBlog($blog);
            }

            return $this->redirect()->toRoute('blog');
        }

        return new ViewModel(array(
            'blog' => $blog
        ));
    }
} 