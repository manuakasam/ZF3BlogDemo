<?php
namespace Album\Form;

use Zend\Form\Form;

class InsertForm extends Form
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

        // Remove the ID Element on Insert since it's not required
        $this->get('album')->remove('id');

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save Album'
            ]
        ]);
    }
} 