<?php

namespace JydFsm\Entity\Guard;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class DummyGuard
 *
 * @package JydFsm\Entity\Guard
 *
 * @ORM\Entity
 */
class ElementsValidGuard extends Guard
{
    /**
     * {@inheritdoc}
     * This concrete guard checks that the elements in the state are valid
     *
     * @return Result
     */
    public function check()
    {
        $state = $this->getTransition()->getState();

        foreach ( $state->getElements() as $element ) {
            if ( !$element->isValid() ) {
                return new Result($this->getName(), $this->getDescription(), false, 'Guard Failed');
            }
        }

        return new Result($this->getName(), $this->getDescription());
    }
}