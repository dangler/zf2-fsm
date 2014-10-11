<?php

namespace JydFsm\Factory;

use JydFsm\Entity\Validator\DummyValidator;
use Zend\Config\Config;

class Validator
{

    public function createValidator(Config $config)
    {
        switch(strtolower($config->type)) {
            case 'dummy':
                $validator = new DummyValidator();
                $validator->setName($config->name);
                $validator->setDescription($config->description);
                return $validator;
        }
    }
}
