<?php

namespace JydFsm\Entity\Element;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JydFsm\Entity\State;

/**
 * Class Element
 *
 * @package JydFsm\Entity\Element
 *
 * @ORM\Entity
 * @ORM\Table(name="element")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="descr", type="string")
 * @ORM\DiscriminatorMap({"dummy"="DummyElement"})
 */
abstract class Element
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
     * @ORM\ManyToOne(targetEntity="JydFsm\Entity\State", inversedBy="elements")
     *
     * @var State
     */
    private $state;
}
