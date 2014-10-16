<?php

namespace JydFsm\Entity\Element;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JydFsm\Entity\State;
use JydFsm\Entity\Validator\Result;
use JydFsm\Entity\Validator\Validator;

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
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="JydFsm\Entity\State", inversedBy="elements")
     *
     * @var State
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="JydFsm\Entity\State", inversedBy="elements")
     *
     * @var Machine
     */
    private $machine;

    /**
     * @ORM\OneToMany(targetEntity="JydFsm\Entity\Validator\Validator", mappedBy="element")
     *
     * @var ArrayCollection
     */
    private $validators;

    public function __construct()
    {
        $this->validators = new ArrayCollection();
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
    public function hasValidators()
    {
        return !$this->validators->isEmpty();
    }

    /**
     * @param Validator $validator
     */
    public function addValidator(Validator $validator)
    {
        $this->validators->add($validator);
    }

    public function validate()
    {
        $result = $this->checkValidators();

        if ($result !== true) {
            return $result;
        }
    }

    /**
     *
     */
    public function checkValidators()
    {
        // collect all validator results
        $validatorResults = $this->validators->map(
            function($validator){
                /** @var Validator $validator */
                return $validator->validate();
            }
        );

        // predicate function for - if validatorResults is not empty, check if any validators failed
        $validatorResultPredicate = function($key, $validatorResult) {
            /** @var Result $validatorResult */
            if($validatorResult) {
                return $validatorResult->result;
            }
        };

        // if any validators failed then return
        if (!$validatorResults->forAll($validatorResultPredicate)) {
            return $validatorResults;
        } else {
            return true;
        }
    }
}
