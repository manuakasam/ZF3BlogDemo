<?php
namespace Album\Form;

use Zend\Form\Form;

class DeleteAlbumForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'security_check',
            'type' => 'csrf'
        ));

        $this->add(array(
            'name'    => 'delete_confirmation',
            'type'    => 'checkbox',
            'options' => array(
                'label'              => 'Confirm deletion',
                'use_hidden_element' => true,
                'checked_value'      => 'yes',
                'unchecked_value'    => 'no'
            )
        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Delete Album'
            )
        ));
    }
}