<?php
namespace Album\Form;

use Album\Entity\Album;
use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class AlbumFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new Album());
    }

    public function init()
    {
        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title'
            ]
        ]);

        $this->add([
            'name' => 'artist',
            'type' => 'text',
            'options' => [
                'label' => 'Artist'
            ]
        ]);
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
            'id' => [
                'filter' => [
                    ['name' => 'int']
                ],
                'required' => false,
            ],
            'title' => [
                'filter' => [
                    ['name' => 'stringtrim'],
                    ['name' => 'striptags']
                ],
                'required' => true,
            ],
            'artist' => [
                'filter' => [
                    ['name' => 'stringtrim'],
                    ['name' => 'striptags']
                ],
                'required' => true,
            ]
        ];
    }


} 