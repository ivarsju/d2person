<?php

class m140729_162101_alter_ppxs extends CDbMigration
{

    /**
	 * Creates initial version of the table
	 */
    public function up()
    {
        $this->execute("
        ALTER TABLE `ppxs_person_x_setting`
          ADD CONSTRAINT `constrain_ppxs_pprs` FOREIGN KEY (`ppxs_pprs_id`) REFERENCES `pprs_person`(`pprs_id`),
          ADD CONSTRAINT `constrain_ppxs_psty` FOREIGN KEY (`ppxs_psty_id`) REFERENCES `psty_setting_type`(`psty_id`);

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
