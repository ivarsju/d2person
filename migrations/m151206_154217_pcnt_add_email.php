<?php

class m151206_154217_pcnt_add_email extends EDbMigration
{
	public function up()
	{
        $this->execute("REPLACE INTO `pcnt_contact_type` VALUES (1,'email')");
        
	}

	public function down()
	{
		echo "m151206_154217_pcnt_add_email does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}