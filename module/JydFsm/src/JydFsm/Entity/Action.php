<?php
/**
 * Created by PhpStorm.
 * User: jdangler
 * Date: 6/13/2014
 * Time: 10:46 PM
 */

namespace JydFsm\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Action
 *
 * @package JydFsm\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="action")
 */
class Action 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

} 