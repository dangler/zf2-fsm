<?php

namespace JydFsm\Entity\Action;


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
