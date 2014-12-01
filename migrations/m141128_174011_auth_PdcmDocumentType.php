<?php
 
class m141128_174011_auth_PdcmDocumentType extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PdcmDocumentType.*','0','D2person.PdcmDocumentType',NULL,'N;');
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name`= 'D2person.PdcmDocumentType.*';
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


