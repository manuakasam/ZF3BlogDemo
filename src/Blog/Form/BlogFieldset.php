<?php
// Filename: /module/Blog/src/Blog/Form/BlogFieldset.php
namespace Blog\Form;

use Blog\Model\Blog;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class BlogFieldset extends Fieldset
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new Blog());

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'options' => array(
                'label' => 'Blog Title'
            )
        ));

        $this->add(array(
            'type' => 'textarea',
            'name' => 'text',
            'options' => array(
                'label' => 'The Text'
            )
        ));
    }
}