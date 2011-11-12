<?php

class LocaleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if (Zend_Validate::is($this->getRequest()->getParam('locale'), 'InArray', array('haystack' => array('pt_PT', 'en_US')))) {
      $session = new Zend_Session_Namespace('rps.l10n');
      $session->locale = $this->getRequest()->getParam('locale');
        }

    // redirect to requesting URL
    $url = $this->getRequest()->getServer('HTTP_REFERER');
    $this->_redirect($url);
    }


}

