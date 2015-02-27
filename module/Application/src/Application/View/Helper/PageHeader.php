<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class PageHeader extends AbstractHelper
{
    public function __invoke()
    {
        $h = '';
        if ($this->view->headTitle() != '')
            $h = $this->view->headTitle()->renderTitle() . '<br/>';

        ?>
        <div class='page-header'>
            <h2>
                <?=$h?>
            </h2>
        </div>
        <?php

        return ob_get_clean();
    }
} 