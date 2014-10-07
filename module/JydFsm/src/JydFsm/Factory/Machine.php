<?php

namespace JydFsm\Factory;


use Zend\Config\Config;

class Machine
{
    public function createMachine(Config $config)
    {
        $machine = new \JydFsm\Entity\Machine();

        // make sure it has required data
        // states
        if (!isset($config->states)) {
            throw new \Exception;
        }

        // transitions
        if (!isset($config->transitions)) {
            throw new \Exception;
        }

        $stateFactory = new State();
        $transFactory = new Transition();

        // get all the states
        $states = array();
        foreach ($config->states as $stateConfig) {
            $states[$stateConfig->name] = $stateFactory->createState($machine, $stateConfig);
        }

        // get all the transitions and add to their state
        $transitions = array();
        foreach ($config->transitions as $transConfig) {
            $transitions[$transConfig->name] =
                $transFactory->createTransition(
                    $machine,
                    $states[$transConfig->state],
                    $states[$transConfig->target],
                    $transConfig
                );

            $states[$transConfig->state]->addTransition($transitions[$transConfig->name]);
        }

        // add the states to the machine
        foreach ($states as $state) {
            $machine->addState($state);
        }

        return $machine;
    }
}
