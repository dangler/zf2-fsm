<?php
/**
 * Created by PhpStorm.
 * User: dangler
 * Date: 12/16/14
 * Time: 5:29 PM
 */


class StateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \JydFsm\Entity\State
     */
    protected $state;

    protected $machine;
    protected $target;
    protected $element;
    protected $action;
    protected $role;
    protected $transition;

    public function setUp()
    {
        // create stubs for the dependencies
        $this->machine = $this->getMockBuilder('\JydFsm\Entity\Machine')
            ->getMock();
        $this->target = $this->getMockBuilder('\JydFsm\Entity\State')
            ->setConstructorArgs(array($this->machine))
            ->getMock();
        $this->element = $this->getMockBuilder('\JydFsm\Entity\Element\Element')
            ->getMock();
        $this->action = $this->getMockBuilder('\JydFsm\Entity\Action\Action')
            ->getMock();
        $this->role = $this->getMockBuilder('\JydFsm\Entity\Role')
            ->getMock();

        $this->state = new \JydFsm\Entity\State($this->machine);

        $this->transition = $this->getMockBuilder('\JydFsm\Entity\Transition')
            ->setConstructorArgs(array($this->machine, $this->state, $this->target))
            ->getMock();

    }

    public function testAddElement()
    {
        $this->state->addElement($this->element);

        $this->assertTrue($this->state->hasElements());
    }

    public function testAddOnEntryActions()
    {
        $this->assertFalse($this->state->hasOnEntryActions());

        $this->state->addOnEntryAction($this->action);

        $this->assertTrue($this->state->hasOnEntryActions());
    }

    public function testAddOnExitActions()
    {
        $this->assertFalse($this->state->hasOnExitActions());

        $this->state->addOnExitAction($this->action);

        $this->assertTrue($this->state->hasOnExitActions());
    }

    public function testAddRole()
    {
        $this->assertFalse($this->state->hasRoles());

        $this->state->addRole($this->role);

        $this->assertTrue($this->state->hasRoles());
    }

    public function testAddTransition()
    {
        $this->assertFalse($this->state->hasTransitions());

        $this->state->addTransition($this->transition);

        $this->assertTrue($this->state->hasTransitions());
    }

    public function testGetDefaultTransitionWithNoTransitions()
    {
        // throw exception if no transitions exist
        $this->setExpectedException('Exception');

        $this->state->getDefaultTransition();
    }

    public function testGetDefaultTransition()
    {
        // if not set return first
        // STOPPED HERE

        $this->state->getDefaultTransition();
    }

    public function testGetTransition()
    {

        // mocks some transitions
        $t1 = $this->getMockBuilder('\JydFsm\Entity\Transition')
            ->setConstructorArgs(array($this->machine, $this->state, $this->target))
            ->getMock();

        $t1->method('getName')
            ->willReturn('T1');

        $t2 = $this->getMockBuilder('\JydFsm\Entity\Transition')
            ->setConstructorArgs(array($this->machine, $this->state, $this->target))
            ->getMock();

        $t2->method('getName')
            ->willReturn('T2');

        $t3 = $this->getMockBuilder('\JydFsm\Entity\Transition')
            ->setConstructorArgs(array($this->machine, $this->state, $this->target))
            ->getMock();

        $t3->method('getName')
            ->willReturn('T3');

        // add transitions
        $this->state->addTransition($t1);
        $this->state->addTransition($t2);
        $this->state->addTransition($t3);

        // test getTransition method
        $this->assertEquals($t1, $this->state->getTransition('T1'));
        $this->assertEquals($t2, $this->state->getTransition('T2'));
        $this->assertEquals($t3, $this->state->getTransition('T3'));
    }


}