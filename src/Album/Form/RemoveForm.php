<?php
namespace Album\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Digits;

class RemoveForm extends Form implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add(
            [
                'name' => 'securitycheck',
                'type' => 'csrf'
            ]
        );

        $this->add(
            [
                'name'       => 'confirmation',
                'type'       => 'checkbox',
                'options'    => [
                    'label' => 'Confirm deletion',
                    'use_hidden_element' => true,
                    'checked_value' => 1,
                    'unchecked_value' => 'no'
                ],
                'attributes' => [
                    'value' => 'yes'
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'submit',
                'type'       => 'submit',
                'attributes' => [
                    'value' => 'Delete Album'
                ]
            ]
        );
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'confirmation' => [
                'validators' => [
                    ['name' => 'digits', 'options' => [ 'messages' => [
                        Digits::NOT_DIGITS => 'You need to check this box to delete the Album.'
                    ]]]
                ]
            ]
        ];
    }


} 