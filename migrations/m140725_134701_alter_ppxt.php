<?php

class m140725_134701_alter_ppxt extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            ALTER TABLE `ppxt_person_x_type`   
                CHANGE `ppxt_ptyp_id` `ppxt_ptyp_id` TINYINT(5) UNSIGNED NULL  COMMENT 'Group';

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
