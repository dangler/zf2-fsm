<?php

namespace JydFsm\Entity\Validator;

/**
 * Class Result
 *
 * This is a value object and should not be persisted.  It is used to get validator check errors back when validating
 *      data elements.
 *
 * @package JydFsm\Entity\Validator
 */
class Result
{
    /**
     * @var string
     */
    public $validatorName;

    /**
     * @var string
     */
    public $validatorDescription;

    /**
     * @var bool
     */
    public $result;

    /**
     * @var string
     */
    public $message;

    /**
     * @param $validatorName
     * @param $validatorDescription
     * @param bool $result
     * @param null $message
     */
    function __construct($validatorName, $validatorDescription, $result = true, $message= null)
    {
        $this->validatorName = $validatorName;
        $this->validatorDescription = $validatorDescription;
        $this->result = $result;
        $this->message = $message;
    }
}
