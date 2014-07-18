<?php

namespace JydFsm\Factory;


class Machine
{
    public function createMachine()
    {
        return new \JydFsm\Entity\Machine();
    }
}
