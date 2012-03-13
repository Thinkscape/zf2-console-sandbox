<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class IndexController extends ActionController
{
    public function indexAction()
    {
        print_r($this->getRequest()->getParams);

        exit;
        return new ViewModel();
    }

    public function usageAction()
    {
        echo "usage!";
        exit;
    }
}
