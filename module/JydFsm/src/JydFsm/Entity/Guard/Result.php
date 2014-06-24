<?php

namespace JydFsm\Entity\Guard;

/**
 * Class Result
 *
 * This is a value object and should not be persisted.  It is used to get guard checks back when trying to
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
     * @var bool
     */
    public $result;

    /**
     * @var string
     */
    public $message;

    /**
     * @param $guardName string
     * @param $message string
     * @param $result bool
     */
    function __construct($guardName, $message, $result = null)
    {
        $this->guardName = $guardName;
        $this->message = $message;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getGuardName()
    {
        return $this->guardName;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return boolean
     */
    public function getResult()
    {
        return $this->result;
    }

}
