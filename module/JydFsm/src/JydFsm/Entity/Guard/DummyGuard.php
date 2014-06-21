<?php

namespace JydFsm\Entity\Guard;

class DummyGuard extends Guard
{

    /**
     * {@inheritdoc}
     * This concrete guard does not perform any check, it only returns true
     *
     * @return bool
     */
    public function check()
    {
        return true;
    }
}
