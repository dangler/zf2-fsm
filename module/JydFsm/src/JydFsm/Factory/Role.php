<?php

namespace JydFsm\Factory;

use Zend\Config\Config;

class Role
{

    public function createRole(Config $config)
    {
        $role = new \JydFsm\Entity\Role();

        // make sure the config has the required data
        // TODO: refactor to custom exceptions
        if (!isset($config->name)) {
            throw new \Exception;
        }

        if (!isset($config->description)) {
            throw new \Exception;
        }

        $role->setName($config->name);
        $role->setDescription($config->description);

        return $role;
    }
}
