<?php

namespace JydFsm\Entity\Validator;

class DummyValidator extends Validator
{
    /**
     * @return Result
     */
    public function validate()
    {
        return new Result($this->getName(), $this->getDescription());
    }

}
