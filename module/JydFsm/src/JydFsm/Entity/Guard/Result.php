<?php

namespace JydFsm\Entity\Guard;

/**
 * Class Result
 *
 * This is a value object and should not be persisted.  It is used to get guard check errors back when trying to
 *      execute a transition.
 *
 * @package JydFsm\Entity\Guard
 */
class Result
{
    /**
     * @var string
     */
    public $guardName;


    /**
     * @var string
     */
    public $guardDescription;

    /**
     * @var boolean
     */
    public $result;

    /**
     * @var string
     */
    public $message;

    /**
     * @param $guardName string
     * @param $guardDescription string
     * @param $result bool
     * @param $message string
     */
    function __construct($guardName, $guardDescription, $result = true, $message = null)
    {
        $this->guardName = $guardName;
        $this->guardDescription = $guardDescription;
        $this->message = $message;
        $this->result = $result;
    }
}
