<?php

namespace JydFsm\Entity\Action;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EmailAction
 *
 * @package JydFsm\Entity\Action
 *
 * @ORM\Entity
 */
class EmailAction extends Action
{
    public function __construct($recipientName, $recipientEmail, $content)
    {

    }

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
