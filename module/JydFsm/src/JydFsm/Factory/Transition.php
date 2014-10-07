<?php

namespace JydFsm\Factory;

use JydFsm\Entity\Machine as MachineEntity;
use JydFsm\Entity\State as StateEntity;
use Zend\Config\Config;

class Transition
{

    public function createTransition(MachineEntity $machine, StateEntity $state, StateEntity $target, Config $config)
    {
        $transition = new \JydFsm\Entity\Transition($machine, $state, $target);

        // make sure the config has the required data
        // TODO: refactor to custom exceptions
        if (!isset($config->name)) {
            throw new \Exception;
        }

        $transition->setName($config->name);

        return $transition;
    }
}
