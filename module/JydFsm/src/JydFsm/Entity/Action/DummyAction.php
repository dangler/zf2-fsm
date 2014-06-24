<?php

namespace JydFsm\Entity\Action;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class DummyAction
 *
 * @package JydFsm\Entity\Action
 *
 * @ORM\Entity
 */
class DummyAction extends Action
{
    /**
     * {@inheritdoc}
     * This concrete action does nothing, it only returns true
     *
     * @return bool
     */
    public function invoke()
    {
        return true;
    }
}
