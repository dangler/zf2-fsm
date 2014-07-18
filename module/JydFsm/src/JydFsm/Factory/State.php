<?php

namespace JydFsm\Factory;

use JydFsm\Entity\Machine as MachineEntity;
use Zend\Config\Config;

class State
{
    public function createState(MachineEntity $machine, Config $config)
    {
        $machine = new \JydFsm\Entity\State($machine);

        $machine->setName($config->name);
        $machine->setDescription($config->description);

        return $machine;
    }
}
