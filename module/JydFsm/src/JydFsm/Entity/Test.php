<?php

namespace JydFsm\Entity;


use Doctrine\ORM\Mapping as ORM;

class Test
{
    private $firstName;



    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($name)
    {
        $this->firstName = $name;
    }
}
