<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\Plugin\Url;

class TopNav extends AbstractHelper
{
    public function __invoke()
    {
        ?>
        <div class="navbar navbar-default">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Display Logout Link -->
                        <li>
                            <a href="<?php echo $this->view->url('user', array('action' => 'logout')); ?>">
                                <i class="fa fa-power-off"></i> <?php echo 'Logout'; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php

        return ob_get_clean();
    }
}