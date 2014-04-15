<?php
namespace Album\Form;

use Zend\Form\Form;

class UpdateForm extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'securitycheck',
            'type' => 'csrf'
        ]);

        $this->add([
            'name' => 'album',
            'type' => AlbumFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Update Album Information'
            ]
        ]);
    }
} 