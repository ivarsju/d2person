<?php
 
class m141006_125610_auth_PpxsPersonXSetting extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxsPersonXSetting.*','0','D2person.PpxsPersonXSetting',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxsPersonXSetting.Create','0','D2person.PpxsPersonXSetting module create',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxsPersonXSetting.View','0','D2person.PpxsPersonXSetting module view',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxsPersonXSetting.Update','0','D2person.PpxsPersonXSetting module update',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PpxsPersonXSetting.Delete','0','D2person.PpxsPersonXSetting module delete',NULL,'N;');
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name` = 'D2person.PpxsPersonXSetting.*';
            DELETE FROM `authitem` WHERE `name` = 'D2person.PpxsPersonXSetting.edit';
            DELETE FROM `authitem` WHERE `name` = 'D2person.PpxsPersonXSetting.fullcontrol';
            DELETE FROM `authitem` WHERE `name` = 'D2person.PpxsPersonXSetting.readonly';
            DELETE FROM `authitem` WHERE `name` = 'D2person.PpxsPersonXSettingEdit';
            DELETE FROM `authitem` WHERE `name` = 'D2person.PpxsPersonXSettingView';
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


