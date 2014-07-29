<?php

class m140729_161901_create_ppxs extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            CREATE TABLE `ppxs_person_x_setting`(  
              `ppxs_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `ppxs_pprs_id` SMALLINT UNSIGNED NOT NULL,
              `ppxs_psty_id` SMALLINT UNSIGNED,
              `ppxs_value` VARCHAR(256),
              `ppxs_notes` TEXT,
              `ppxs_hidded` TINYINT UNSIGNED NOT NULL DEFAULT 0,
              PRIMARY KEY (`ppxs_id`)
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
