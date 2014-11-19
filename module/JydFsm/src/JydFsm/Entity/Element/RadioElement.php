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
class RadioElement extends Element
{
    static protected $type = 'radio';

    /**
     * @ORM\Column(type="array")
     *
     * @var array
     */
    private $options = array();

    /**
     * @var string
     *
     * defaults to 0, the first
     */
    private $selected = null;

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return int
     */
    public function getSelected()
    {
        if ($this->selected == null) {
            return key($this->options);
        }

        return $this->selected;
    }

    /**
     * @param $selected
     * @throws \Exception
     */
    public function setSelected($selected)
    {
        if (!array_key_exists($selected, $this->options)) {
            throw new \Exception;
        }

        $this->selected = $selected;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addOption($key, $value)
    {
        $this->options[$key] = $value;
    }
}
