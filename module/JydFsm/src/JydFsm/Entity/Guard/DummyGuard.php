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
class DummyGuard extends Guard
{
    /**
     * {@inheritdoc}
     * This concrete guard does not perform any check, it only returns true result
     *
     * @return Result
     */
    public function check()
    {
        return new Result($this->getName(), $this->getDescription());
    }
}
