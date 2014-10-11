<?php

namespace JydFsm\Factory;

use JydFsm\Entity\Element\DummyElement;
use Zend\Config\Config;

class Element
{

    public function createElement(Config $config)
    {
        switch(strtolower($config->type)) {
            case 'dummy':
                $element = new DummyElement();
                $element->setName($config->name);
                return $element;
        }
    }
}
