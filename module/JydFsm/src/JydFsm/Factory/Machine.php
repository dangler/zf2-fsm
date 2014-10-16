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

        // elements
        if (!isset($config->elements)) {
            throw new \Exception;
        }

        $stateFactory = new State();
        $transFactory = new Transition();
        $elementsFactory = new Element();
        $actionFactory = new Action();
        $guardFactory = new Guard();

        // get all the states
        $states = array();
        foreach ($config->states as $stateConfig) {
            $state = $stateFactory->createState($machine, $stateConfig);

            // get and add the onEntryActions and onExitActions
            foreach ($stateConfig->onEntryActions as $entryConfig) {
                $state->addOnEntryAction($actionFactory->createAction($entryConfig));
            }
            foreach ($stateConfig->onExitActions as $exitConfig) {
                $state->addOnExitAction($actionFactory->createAction($exitConfig));
            }

            $states[$stateConfig->name] = $state;
        }

        // get all the transitions and add to their state
        foreach ($config->transitions as $transConfig) {
            $transition =
                $transFactory->createTransition(
                    $machine,
                    $states[$transConfig->state],
                    $states[$transConfig->target],
                    $transConfig
                );

            // get and add the actions
            foreach ($transConfig->actions as $actionConfig) {
                $transition->addAction($actionFactory->createAction($actionConfig));
            }

            // get and add the guards
            foreach ($transConfig->guards as $guardConfig) {
                $transition->addGuard($guardFactory->createGuard($guardConfig));
            }

            $states[$transConfig->state]->addTransition($transition);
        }

        // get all the elements and add to the machine and their state
        foreach ($config->elements as $elementConfig) {
            $element = $elementsFactory->createElement($elementConfig);

            $machine->addElement($element);
            $states[$elementConfig->state]->addElement($element);
        }

        // add the states to the machine
        foreach ($states as $state) {
            $machine->addState($state);
        }

        return $machine;
    }
}
