<?php

namespace JydFsm\Factory;

use JydFsm\Entity\Guard\DummyGuard;
use JydFsm\Entity\Guard\ElementsValidGuard;
use Zend\Config\Config;

class Guard
{

    public function createGuard(Config $config)
    {
        switch(strtolower($config->type)) {
            case 'dummy':
                $guard = new DummyGuard();
                $guard->setName($config->name);
                $guard->setDescription($config->description);
                return $guard;
                break;
            case 'elements-valid':
                $guard = new ElementsValidGuard();
                $guard->setName($config->name);
                $guard->setDescription($config->description);
                return $guard;
                break;
        }
    }
}
