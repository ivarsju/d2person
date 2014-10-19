<?php
 
class m141019_110410_pprs_add_status extends CDbMigration
{

    public function up()
    {
        $this->execute("
            ALTER TABLE `pprs_person`   
              ADD COLUMN `pprs_status` ENUM('active','inactive') DEFAULT 'active'   NULL AFTER `pprs_second_name`;

        ");
    }

    public function down()
    {

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


