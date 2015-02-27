<?php
/**
 * Created by PhpStorm.
 * User: dangler
 * Date: 2/27/15
 * Time: 10:21 AM
 */

namespace Application\Form;


use Zend\Form\Form;

class Login extends Form {

    public function __construct($name = null)
    {
        parent::__construct('Login');

        $this->setAttribute('class', 'form-horizontal login-forme');

        //add username field
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type' => 'username',
                'placeholder' => 'Username',
                'id' => 'inputUsername'
            ),
            'options' => array(
                'label' => 'Username',
                'column-size' => 'sm-10',
                'label_attributes' => array('class' => 'col-sm-2 control-label')
            )
        ));

        //add password field
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Password',
                'id' => 'inputPassword'
            ),
            'options' => array(
                'label' => 'Password',
                'column-size' => 'sm-10',
                'label_attributes' => array('class' => 'col-sm-2 control-label')
            )
        ));

        //add submit button
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array('type' => 'submit'),
            'options' => array('label' => 'Sign in','column-size' => 'sm-10 col-sm-offset-2')
        ));
    }
} 