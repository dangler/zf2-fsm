<?php

namespace JydFsm\Factory;

use JydFsm\Entity\Action\DummyAction;
use Zend\Config\Config;

class Action
{

    public function createAction(Config $config)
    {
        switch(strtolower($config->type)) {
            case 'dummy':
                return new DummyAction();
        }
    }
}
