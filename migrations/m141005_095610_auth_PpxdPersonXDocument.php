<?php
 
class m141005_095610_auth_PpxdPersonXDocument extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxdPersonXDocument.*','0','D2person.PpxdPersonXDocument',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxdPersonXDocument.Create','0','D2person.PpxdPersonXDocument module create',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxdPersonXDocument.View','0','D2person.PpxdPersonXDocument module view',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxdPersonXDocument.Update','0','D2person.PpxdPersonXDocument module update',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxdPersonXDocument.Delete','0','D2person.PpxdPersonXDocument module delete',NULL,'N;');

            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpxdPersonXDocument.Update'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpxdPersonXDocument.Create'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpxdPersonXDocument.Delete'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonUpdate', 'D2person.PpxdPersonXDocument.*'); 
            INSERT INTO `authitemchild` (`parent`, `child`) VALUES ('D2person.PprsPersonView', 'D2person.PpxdPersonXDocument.View'); 


        ");
    }

    public function down()
    {
        $this->execute("

            DELETE FROM authitemchild where parent like 'D2person.PpcnPersonContact.%';
            DELETE FROM `authitem` WHERE `name` like 'D2person.PpxdPersonXDocument.%';
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


