<?php

namespace JydFsm\Entity\Action;

use JydFsm\Entity\Action\Action;

class DummyAction extends Action
{
    public function invoke()
    {
        return true;
    }
}
