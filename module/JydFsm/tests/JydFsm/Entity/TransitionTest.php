<?php

class TransitionTest extends PHPUnit_Framework_TestCase
{
    /** @var \JydFsm\Entity\Transition */
    protected $transition;

    // dependencies
    protected $machine;
    protected $state;
    protected $target;
    protected $guard;

    public function setUp()
    {
        // create stubs for the dependencies
        $this->machine = $this->getMockBuilder('\JydFsm\Entity\Machine')
            ->getMock();
        $this->state = $this->getMockBuilder('\JydFsm\Entity\State')
            ->setConstructorArgs(array($this->machine))
            ->getMock();
        $this->target = $this->getMockBuilder('\JydFsm\Entity\State')
            ->setConstructorArgs(array($this->machine))
            ->getMock();
        $this->guard = $this->getMockBuilder('\JydFsm\Entity\Guard\Guard')
            ->getMock();

        // create unit under testing
        $this->transition = new \JydFsm\Entity\Transition($this->machine, $this->state, $this->target);
    }

    public function testConstructor()
    {
        // create stubs for the dependencies
        $machine = $this->getMockBuilder('\JydFsm\Entity\Machine')
            ->getMock();
        $state = $this->getMockBuilder('\JydFsm\Entity\State')
            ->setConstructorArgs(array($machine))
            ->getMock();
        $target = $this->getMockBuilder('\JydFsm\Entity\State')
            ->setConstructorArgs(array($machine))
            ->getMock();

        $transition = new \JydFsm\Entity\Transition($machine, $state, $target);
        $this->assertEquals($state, $transition->getState());
        $this->assertEquals($target, $transition->getTarget());
    }

    public function testSetName()
    {
        $this->transition->setName('TransName');

        $this->assertEquals('TransName', $this->transition->getName());
    }

    public function testAddAction()
    {
        // mock action
        $action = $this->getMockBuilder('\JydFsm\Entity\Action\Action')->getMock();

        $this->assertFalse($this->transition->hasActions());
        $this->transition->addAction($action);
        $this->assertTrue($this->transition->hasActions());
    }

    public function testAddGuard()
    {
        $this->assertFalse($this->transition->hasGuards());
        $this->transition->addGuard($this->guard);
        $this->assertTrue($this->transition->hasGuards());
    }

    public function testCheckGuards()
    {
        // set up expected behavior
        $this->guard->expects($this->once())
            ->method('check');

        // add guard
        $this->transition->addGuard($this->guard);

        // call method under test
        $this->transition->checkGuards();
    }

    public function testExecute()
    {
        // set up mocks
        // add actions to the transition
        $action1 = $this->getMockBuilder('\JydFsm\Entity\Action\Action')
            ->setMethods(array('invoke'))
            ->getMock();

        $action2 = $this->getMockBuilder('\JydFsm\Entity\Action\Action')
            ->setMethods(array('invoke'))
            ->getMock();

        $this->transition->addAction($action1);
        $this->transition->addAction($action2);

        //add guard, need guard->check to return Guard\Result
        $guardResult = $this->getMockBuilder('\JydFsm\Entity\Guard\Result')
            ->setConstructorArgs(array('Name', 'Desc'))
            ->getMock();

        $this->guard->method('check')
            ->willReturn($guardResult);

        $this->transition->addGuard($this->guard);

        // ensure the state's on exit actions are called
        $this->state->expects($this->once())
            ->method('invokeOnExitActions');

        // ensure the transitions actions are called
        $action1->expects($this->once())
            ->method('invoke');
        $action2->expects($this->once())
            ->method('invoke');

        // ensure the target's on entry actions are called
        $this->target->expects($this->once())
            ->method('invokeOnEntryActions');

        // ensure the machines current state is changed to the target
        $this->machine->expects($this->once())
            ->method('setCurrentState')
            ->with($this->target);

        // execute
        $this->transition->execute();
    }
}