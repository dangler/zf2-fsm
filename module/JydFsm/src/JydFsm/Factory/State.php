<?php

namespace JydFsm\Factory;

use JydFsm\Entity\Machine as MachineEntity;
use Zend\Config\Config;

class State
{
    public function createState(MachineEntity $machine, Config $config)
    {
        $machine = new \JydFsm\Entity\State($machine);

        // ensure the required config data is present
        // TODO: refactor to custom exceptions
        if (!isset($config->name)) {
            throw new \Exception;
        }

        if (!isset($config->description)) {
            throw new \Exception;
        }

        $machine->setName($config->name);
        $machine->setDescription($config->description);

        return $machine;
    }
}
