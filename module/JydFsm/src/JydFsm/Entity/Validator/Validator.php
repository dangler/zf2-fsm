<?php

namespace JydFsm\Entity\Validator;

use Doctrine\ORM\Mapping as ORM;

use JydFsm\Entity\Element\Element;

/**
 * Class Validator
 *
 * @package JydFsm\Entity\Validator
 *
 * @ORM\Entity
 * @ORM\Table(name="validator")
 */
abstract class Validator
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="JydFsm\Entity\Element\Element", inversedBy="validators")
     *
     * @var Element
     */
    private $element;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Element
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param Element $element
     */
    public function setElement($element)
    {
        $this->element = $element;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    abstract public function validate();
}
