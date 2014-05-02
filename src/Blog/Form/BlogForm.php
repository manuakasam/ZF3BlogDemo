<?php
// Filename: /module/Blog/src/Blog/Form/InsertBlogForm.php
namespace Blog\Form;

use Zend\Form\Form;

class BlogForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'blog-fieldset',
            'type' => 'Blog\Form\BlogFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Insert new Blog'
            )
        ));
    }
}