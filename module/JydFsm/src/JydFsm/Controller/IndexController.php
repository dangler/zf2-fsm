<?php

namespace JydFsm\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class IndexController extends AbstractActionController
{
    /**
     * @var Doctrine\ORM\EntityManger
     */
    protected $em;

    /**
     * @return Doctrine\ORM\EntityManger
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'states' => $this->getEntityManager()->getRepository('JydFsm\Entity\State')->findAll()
        ));
    }


}

