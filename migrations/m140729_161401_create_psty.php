<?php

class m140729_161401_create_psty extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            CREATE TABLE `psty_setting_type`(  
              `psty_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
              `psty_name` VARCHAR(256) NOT NULL,
              `psty_field_type` ENUM('int','char','date','email','money') NOT NULL,
              `psty_hidded` TINYINT NOT NULL DEFAULT 0,
              PRIMARY KEY (`psty_id`)
            ) ENGINE=INNODB CHARSET=utf8;

        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->execute("

        ");
	}

	/**
	 * Creates initial version of the table in a transaction-safe way.
	 * Uses $this->up to not duplicate code.
	 */
	public function safeUp()
	{
		$this->up();
	}

	/**
	 * Drops the table in a transaction-safe way.
	 * Uses $this->down to not duplicate code.
	 */
	public function safeDown()
	{
		$this->down();
	}
}
