<?php

class ProjectsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $page = $this->getRequest()->getParam('filename');
        $this->render($page);
    }


}

