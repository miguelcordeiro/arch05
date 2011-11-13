<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

 protected function _initTranslate()
      {


      $locale = null;

      $session = new Zend_Session_Namespace('rps.l10n');
        if ($session->locale) {
          $locale = new Zend_Locale($session->locale);
        }

        if ($locale === null) {

            try {
                   $locale = new Zend_Locale('browser');
                } catch (Zend_Locale_Exception $e) {
                   $locale = new Zend_Locale('en_US');
                }
        }

        $registry = Zend_Registry::getInstance();
        $registry->set('Zend_Locale', $locale);

      
	   $translate = new Zend_Translate(
								    	array(
								        'adapter' => 'Csv',
								        'content' => APPLICATION_PATH . '/languages/pt_PT/pt_PT.csv',
								        'locale'  => 'pt_PT'
								    	)
									);
		$translate->addTranslation(
		    array(
		        'content' => APPLICATION_PATH . '/languages/en_GB/en_GB.csv',
		        'locale' => 'en_US'
		    )
		);
	      
        
        $translate->getAdapter()->setLocale(Zend_Locale::findLocale());
        $registry = Zend_Registry::getInstance();
        $registry->set('Zend_Translate', $translate);


      }


		protected function _initHeader ()
        {
            $this->bootstrap('layout');
            $layout = $this->getResource('layout');
            $view = $layout->getView();
            $view->translate = Zend_Registry::get('Zend_Translate');
            $view->doctype("XHTML1_STRICT");
            $view->headTitle('AR-CH-05');
            $view->headLink()->headLink(array('rel' => 'favicon', 'href' => '/images/comuns/favicon.ico'), 'PREPEND');
            $view->headLink()->headLink(array('rel' => 'icon', 'href' => '/images/comuns/favicon.ico'), 'PREPEND');
            $view->headMeta()->appendHttpEquiv('Content-Language', str_replace("_", '-', Zend_Locale::findLocale()));
            $view->headMeta()->appendHttpEquiv('X-UA-Compatible', 'chrome=1');
            $view->headMeta()->appendName('Developer', 'Ricardo Simao');
            $view->headMeta()->appendName('Email', 'rpsimao@gmail.com');
            $view->headMeta()->appendName('Copyright', 'Arch05');
            $view->headMeta()->appendName('Zend Framework', Zend_Version::VERSION);
            $view->headMeta()->appendName('Version', '@@BuildNumber@@');
            $view->headMeta()->appendName('BuildDate', '@@BuildDate@@');
            $view->headLink()->appendStylesheet('/css/styles.css');

        }
		
		protected function _initRoutes ()
	    {
	
	        $router = Zend_Controller_Front::getInstance()->getRouter();
	
	        $route = new Zend_Controller_Router_Route('/projects/:filename', array(
	            'module' => 'default',
	            'controller' => 'projects' ,
	            'action' => 'index'));
	        $router->addRoute('default_projects_index', $route);
			
			$route = new Zend_Controller_Router_Route('/:filename', array(
	            'module' => 'default',
	            'controller' => 'index' ,
	            'action' => 'index'));
	        $router->addRoute('default_index_index', $route);
		}

}

