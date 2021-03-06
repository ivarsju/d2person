<?php

class D2personModule extends CWebModule
{

    const ALL_COMPANIES = 'A';
    const PERSON_SYS_COMPANIES = 'PSC';
    
    /**
     * user can add 
     * A - all companies
     * PSC - actual person sys companies
     * @var ENUM 
     */
    var $ccucCompanyList = self::ALL_COMPANIES;
    
    var $options = array();
    
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'd2person.models.*',
            'd2person.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }
}
