<?php
 
class m141005_205510_auth_PpxtPersonXType extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxtPersonXType.*','0','D2person.PpxtPersonXType',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxtPersonXType.Create','0','D2person.PpxtPersonXType module create',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxtPersonXType.View','0','D2person.PpxtPersonXType module view',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxtPersonXType.Update','0','D2person.PpxtPersonXType module update',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxtPersonXType.Delete','0','D2person.PpxtPersonXType module delete',NULL,'N;');
            
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpxtPersonXType.Update'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpxtPersonXType.Create'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpxtPersonXType.Delete'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpxtPersonXType.*'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonView', 'D2person.PpxtPersonXType.View'); 


        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitemchild` WHERE `child` like 'D2person.PpxtPersonXType.%';

            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpxtPersonXType.*';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpxtPersonXType.edit';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpxtPersonXType.fullcontrol';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpxtPersonXType.readonly';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpxtPersonXTypeEdit';
            DELETE FROM `AuthItem` WHERE `name` = 'D2person.PpxtPersonXTypeView';
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


