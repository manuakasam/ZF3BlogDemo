<?php
// Filename: /module/Blog/src/Blog/Controller/ListController.php
namespace Blog\Controller;

use Blog\Service\BlogServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{
    /**
     * @var \Blog\Service\BlogServiceInterface
     */
    protected $blogService;

    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'blogs' => $this->blogService->findAllBlogs()
        ));
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');

        try {
            $blog = $this->blogService->findBlog($id);
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('blog');
        }

        return new ViewModel(array(
            'blog' => $blog
        ));
    }
}