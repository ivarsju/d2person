<?php
 
class m141005_095510_auth_PpcnPersonContact extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpcnPersonContact.*','0','D2person.PpcnPersonContact',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpcnPersonContact.Create','0','D2person.PpcnPersonContact module create',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpcnPersonContact.View','0','D2person.PpcnPersonContact module view',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpcnPersonContact.Update','0','D2person.PpcnPersonContact module update',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpcnPersonContact.Delete','0','D2person.PpcnPersonContact module delete',NULL,'N;');
           
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpcnPersonContact.Update'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpcnPersonContact.Create'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpcnPersonContact.Delete'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonView', 'D2person.PpcnPersonContact.View'); 

        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM authitemchild where parent like 'D2person.PpcnPersonContact.%';

            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpcnPersonContact.*';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpcnPersonContact.edit';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpcnPersonContact.fullcontrol';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpcnPersonContact.readonly';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpcnPersonContactEdit';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpcnPersonContactView';
        ");
    }

    public function safeUp()
    {
        $this->up();
    }

    public function safeDown()
    {
        $this->down();
    }
}


