<?php

namespace JydFsm\Entity\Guard;

class DummyGuard extends Guard
{

    /**
     * {@inheritdoc}
     * This concrete guard does not perform any check, it only returns true
     *
     * @return Result
     */
    public function check()
    {
        return new Result($this->getName(), true);
    }
}
