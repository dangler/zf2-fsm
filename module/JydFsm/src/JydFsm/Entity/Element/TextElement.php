<?php

namespace JydFsm\Entity\Element;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TextElement
 *
 * @package JydFsm\Entity\Element
 *
 * @ORM\Entity
 */
class TextElement extends Element
{
    static protected $type = 'text';

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
