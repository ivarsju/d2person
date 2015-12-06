<?php

// auto-loading
Yii::setPathOfAlias('PprsPerson', dirname(__FILE__));
Yii::import('PprsPerson.*');

class PprsPerson extends BasePprsPerson
{
    
    public $pprs_ccmp_id;
    
    /**
     * additional errors
     * @var type 
     */
    public $error = false;
    
    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function getItemLabel()
    {
        return (string) $this->pprs_second_name . ' ' . $this->pprs_first_name;
    }

    public function behaviors() {
        
        $behaviors = parent::behaviors();
        
        //auditrail  
        if(isset(Yii::app()->getModule('d2person')->options['audittrail']) 
            && Yii::app()->getModule('d2person')->options['audittrail'])
        { 
            $behaviors = array_merge(
                $behaviors, array(
            'LoggableBehavior' => array(
                'class' => 'LoggableBehavior'
            ),
        ));            
        }
        
        return $behaviors;
    }
    
    public function rules()
    {
        return array_merge(
                parent::rules(),
                array(
                    array('pprs_ccmp_id, pprs_second_name, pprs_first_name', 'required'),                    
                )    
        );
    }    

    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            array(
                'pprs_ccmp_id' => Yii::t('D2personModule.model', 'Company'),
                )
        );
    }     
    
    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                //'profile' => array(self::BELONGS_TO, 'Profile', 'pprs_id'),
            )
        );
    }

    public function scopes()
    {

    }

    public function filterGroup($group)
    {
        $this->getDbCriteria()->mergeWith(array(
                'join'=>' inner join ppxt_person_x_type on ppxt_pprs_id = t.pprs_id',
                'condition'=>'ppxt_ptyp_id = ' . $group,
        ));

        return $this;
    }
    
    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
            'sort'=>array(
                'defaultOrder'=>'pprs_second_name,pprs_first_name',
            )

        ));
    }

   protected function beforeFind()
   {
        $criteria = new CDbCriteria;
        $criteria->join .= " 
                inner join ccuc_user_company bf1 
                    on bf1.ccuc_person_id = pprs_id 
                        and bf1.ccuc_status = '".CcucUserCompany::CCUC_STATUS_PERSON."'";
        //$criteria->compare('bf1.ccuc_status', CcucUserCompany::CCUC_STATUS_PERSON);
        $sql_sys_persons = '
                  SELECT DISTINCT 
                    ccuc_person_id 
                  FROM
                    ccuc_user_company 
                    INNER JOIN ccmp_company 
                      ON ccuc_ccmp_id = ccmp_id 
                  WHERE ccmp_sys_ccmp_id = '.Yii::app()->sysCompany->getActiveCompany();
        $criteria->addCondition('pprs_id in ('.$sql_sys_persons.')');

        $this->dbCriteria->mergeWith($criteria);
        parent::beforeFind();
    }
    
    public function afterSave() {
        
        //for new records set syscompany
        if(!$this->ccucUserCompanies){
            $ccuc = new CcucUserCompany;
            $ccuc->ccuc_person_id = $this->pprs_id;
            $ccuc->ccuc_ccmp_id = Yii::app()->sysCompany->getActiveCompany();
            $ccuc->ccuc_status = CcucUserCompany::CCUC_STATUS_SYS;
            $ccuc->save();

            //person company
            if(!empty($this->pprs_ccmp_id)){
                $ccuc = new CcucUserCompany;
                $ccuc->ccuc_person_id = $this->pprs_id;
                $ccuc->ccuc_ccmp_id = $this->pprs_ccmp_id;
                $ccuc->ccuc_status = CcucUserCompany::CCUC_STATUS_PERSON;
                $ccuc->save();
            }
        }
        parent::afterSave();
    }
    
    public function getCompanyPersons($ccmp_id,$ccuc_status = CcucUserCompany::CCUC_STATUS_PERSON){
    
        $criteria = new CDbCriteria;    
        $criteria->compare('ccuc_ccmp_id', $ccmp_id);
        $criteria->compare('ccuc_status', $ccuc_status);
        $criteria->order = 'pprs_second_name,pprs_first_name';  
        
        return $this->findAll($criteria);
    }
    
    public  function getSysCompanyPersons(){
        $ccuc_status = array(
            CcucUserCompany::CCUC_STATUS_PERSON,
            CcucUserCompany::CCUC_STATUS_USER,
            CcucUserCompany::CCUC_STATUS_SYS,
            );
        
        return $this->getCompanyPersons(Yii::app()->sysCompany->getActiveCompany(),$ccuc_status);
    }    

/**
     * get all user list
     * @return array(
     *           array(pprs_id=>'1','full_name' => 'Andris Berzins',  
     *           array(pprs_id=>'2','full_name' => 'Karlis Berzins',  
     *              )
     */    
    public static function getPersonsUsers(){
        return self::getPersonsByRole();
    }
    
    /**
     * get users list by role, roles or all
     * @param string/array/boolean $role
     * @return array(
     *           array(pprs_id=>'1','full_name' => 'Andris Berzins',  
     *           array(pprs_id=>'2','full_name' => 'Karlis Berzins',  
     *              )
     */
    public static function getPersonsByRole($role = false){
        $ccuc_status = CcucUserCompany::CCUC_STATUS_SYS;
        $sys_ccmp_id = Yii::app()->sysCompany->getActiveCompany();
        $sql = " 
            SELECT DISTINCT
                
              pprs_id,
              CONCAT(
                pprs_second_name,
                ' ',
                pprs_first_name
              ) full_name 
            FROM
              AuthAssignment aa 
              INNER JOIN `profiles` p 
                ON aa.userid = p.user_id 
              INNER JOIN pprs_person 
                ON p.person_id = pprs_id 
              INNER JOIN ccuc_user_company 
                ON pprs_id = ccuc_person_id 
                AND ccuc_ccmp_id = {$sys_ccmp_id} 
                AND ccuc_status = '{$ccuc_status}' 

                   "
            ;
            
            $where = '';
            if($role && !is_array($role)){
                $where = " WHERE itemname = '{$role}' ";
            }

            if($role && is_array($role)){
                $where = " WHERE itemname in ('".implode("','",$role)."') ";
            }
            
            $sql .= $where . " ORDER BY pprs_second_name,pprs_first_name ";

            return Yii::app()->db->createCommand($sql)->queryAll();
    
    }

    public static function getPersonsByFullName($full_name){
        $ccuc_status = CcucUserCompany::CCUC_STATUS_SYS;
        $sys_ccmp_id = Yii::app()->sysCompany->getActiveCompany();
        $sql = " 
            SELECT 
              pprs_id
            FROM
              AuthAssignment aa 
              INNER JOIN `profiles` p 
                ON aa.userid = p.user_id 
              INNER JOIN pprs_person 
                ON p.person_id = pprs_id 
              INNER JOIN ccuc_user_company 
                ON pprs_id = ccuc_person_id 
                AND ccuc_ccmp_id = :sys_ccmp_id 
                AND ccuc_status = :ccuc_status
              WHERE CONCAT(pprs_second_name,' ',pprs_first_name) = :full_name
                   "
            ;
            
            $command = Yii::app()->db->createCommand($sql);
            
            $command->bindValue(':sys_ccmp_id',$sys_ccmp_id,PDO::PARAM_INT);
            $command->bindValue(':ccuc_status',$ccuc_status,PDO::PARAM_STR);
            $command->bindValue(':full_name',$full_name,PDO::PARAM_STR);
            
            return $command->queryScalar();
    
    }
    
    public function getUserId(){
        $profile = Profile::model()->findByAttributes(['person_id' => $this->pprs_id]);
        if(!$profile){
            return false;
        }       
        
        return $profile->user_id;
    }

    public static function getAllPersonsForList(){
        $sql = " 
            SELECT 
              `pprs_id`,
              CONCAT(
                `pprs_second_name`,
                ' ',
                `pprs_first_name`
              ) itemLabel 
            FROM
              `pprs_person` 
            ORDER BY pprs_second_name,
              pprs_first_name 
        ";
            
            $command = Yii::app()->db->createCommand($sql);
            
            return $command->queryAll();
    
    }    
    
    /**
     * create user account from person data
     * @return boolean|array - error
     */
    public function createUser(){
        
        $password = DbrLib::rand_string(8);
        
        /**
         * create username 
         */
        $firstName = strtolower(iconv('UTF-8','ASCII//TRANSLIT', $this->pprs_first_name));
        $secondName = strtolower(iconv('UTF-8','ASCII//TRANSLIT', $this->pprs_second_name));
        $username = $firstName . substr($secondName, 0, 1);
        $i = 1;
        while(User::model()->findByAttributes(['username'=>$username])){
            $i ++;
            if($i>  strlen($secondName)){
                $username = $firstName . DbrLib::rand_string(2);
            }
            $username = $firstName . substr($secondName, 0, $i);    
        }
        
        /**
         * get email from person contacts
         */
        $contacts = $this->ppcnPersonContacts;
        $email = '';
        foreach($contacts as $contact){
            if($contact->ppcn_pcnt_type == PcntContactType::TYPE_EMAIL ){
                $email = $contact->ppcn_value;
            }
        }
        
        /**
         * create user record
         */
        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->status = User::STATUS_ACTIVE;
        
        if(!$user->validate()){
            return CHtml::errorSummary($user);
        }
        
        $user->save();
        
        /**
         * create profile record
         */
        $profile=new Profile;
        $profile->user_id=$user->id;
        $profile->first_name = $this->pprs_first_name;
        $profile->last_name = $this->pprs_second_name;
        $profile->sys_ccmp_id = Yii::app()->sysCompany->getActiveCompany();
        $profile->person_id=$this->primaryKey;
		$profile->save();  
        
        return true;
        
        
    }
    
}
