<?php

class m140917_173601_init_2 extends CDbMigration
{

    /**
	 * Creates initial version of the table
	 */
    public function up()
    {
        $table_pprs = Yii::app()->db->schema->getTable('pprs_person',true);
        if (!empty($table_pprs)) {
            return;
        }
 
        $this->execute("
            SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

            CREATE TABLE `pcnt_contact_type` (
              `pcnt_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
              `pcnt_name` char(40) NOT NULL COMMENT 'Contact type',
              PRIMARY KEY (`pcnt_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE `pdcm_document_type` (
              `pdcm_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
              `pdcm_name` varchar(50) NOT NULL COMMENT 'Document type',
              `pdcm_hidded` tinyint(4) NOT NULL DEFAULT '0',
              PRIMARY KEY (`pdcm_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE `ppcn_person_contact` (
              `ppcn_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
              `ppcn_pprs_id` smallint(5) unsigned NOT NULL COMMENT 'Person',
              `ppcn_pcnt_type` tinyint(3) unsigned DEFAULT NULL COMMENT 'Contact type',
              `ppcn_value` varchar(500) DEFAULT NULL COMMENT 'Contact',
              `ppcn_notes` text COMMENT 'Notes',
              `ppcn_modified` datetime DEFAULT NULL COMMENT 'Modified',
              PRIMARY KEY (`ppcn_id`),
              KEY `ppcn_pprs_id` (`ppcn_pprs_id`),
              KEY `ppcn_pcnt_type` (`ppcn_pcnt_type`),
              CONSTRAINT `ppcn_person_contact_ibfk_1` FOREIGN KEY (`ppcn_pprs_id`) REFERENCES `pprs_person` (`pprs_id`),
              CONSTRAINT `ppcn_person_contact_ibfk_2` FOREIGN KEY (`ppcn_pcnt_type`) REFERENCES `pcnt_contact_type` (`pcnt_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE `pprs_person` (
              `pprs_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
              `pprs_first_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'First name',
              `pprs_second_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Last name',
              PRIMARY KEY (`pprs_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

            CREATE TABLE `ppxd_person_x_document` (
              `ppxd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `ppxd_pprs_id` smallint(5) unsigned NOT NULL COMMENT 'Person',
              `ppxd_pdcm_id` tinyint(3) unsigned DEFAULT NULL COMMENT 'Document type',
              `ppxd_number` varchar(100) DEFAULT NULL COMMENT 'Number',
              `ppxd_issue_date` date DEFAULT NULL COMMENT 'Issue date',
              `ppxd_expire_date` date DEFAULT NULL COMMENT 'Expire date',
              `ppxd_notes` text COMMENT 'Notes',
              `ppxd_status` enum('ACTIVE','INVALID') DEFAULT NULL COMMENT 'Status',
              PRIMARY KEY (`ppxd_id`),
              KEY `ppxd_pprs_id` (`ppxd_pprs_id`),
              KEY `ppxd_pdcm_id` (`ppxd_pdcm_id`),
              CONSTRAINT `ppxd_person_x_document_ibfk_1` FOREIGN KEY (`ppxd_pprs_id`) REFERENCES `pprs_person` (`pprs_id`),
              CONSTRAINT `ppxd_person_x_document_ibfk_2` FOREIGN KEY (`ppxd_pdcm_id`) REFERENCES `pdcm_document_type` (`pdcm_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE `ppxs_person_x_setting` (
              `ppxs_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `ppxs_pprs_id` smallint(10) unsigned NOT NULL,
              `ppxs_psty_id` smallint(5) unsigned DEFAULT NULL,
              `ppxs_value` varchar(256) DEFAULT NULL,
              `ppxs_notes` text,
              `ppxs_hidded` tinyint(3) unsigned NOT NULL DEFAULT '0',
              PRIMARY KEY (`ppxs_id`),
              KEY `constrain_ppxs_pprs` (`ppxs_pprs_id`),
              KEY `constrain_ppxs_psty` (`ppxs_psty_id`),
              CONSTRAINT `constrain_ppxs_pprs` FOREIGN KEY (`ppxs_pprs_id`) REFERENCES `pprs_person` (`pprs_id`),
              CONSTRAINT `constrain_ppxs_psty` FOREIGN KEY (`ppxs_psty_id`) REFERENCES `psty_setting_type` (`psty_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            CREATE TABLE `ppxt_person_x_type` (
              `ppxt_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
              `ppxt_pprs_id` smallint(5) unsigned NOT NULL COMMENT 'Person',
              `ppxt_ptyp_id` tinyint(5) unsigned DEFAULT NULL COMMENT 'Group',
              PRIMARY KEY (`ppxt_id`),
              KEY `ppxt_ptyp_id` (`ppxt_ptyp_id`),
              KEY `ppxt_pprs_id` (`ppxt_pprs_id`),
              CONSTRAINT `ppxt_person_x_type_ibfk_1` FOREIGN KEY (`ppxt_ptyp_id`) REFERENCES `ptyp_type` (`ptyp_id`),
              CONSTRAINT `ppxt_person_x_type_ibfk_2` FOREIGN KEY (`ppxt_pprs_id`) REFERENCES `pprs_person` (`pprs_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


            CREATE TABLE `psty_setting_type` (
              `psty_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
              `psty_name` varchar(256) NOT NULL,
              `psty_field_type` enum('int','char','date','email','money') NOT NULL,
              `psty_hidded` tinyint(4) NOT NULL DEFAULT '0',
              PRIMARY KEY (`psty_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            CREATE TABLE `ptyp_type` (
              `ptyp_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
              `ptyp_name` char(50) NOT NULL COMMENT 'Group',
              `ptyp_hidden` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Status',
              PRIMARY KEY (`ptyp_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
            
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PprsPerson.*','0','D2person.PprsPerson',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PprsPerson.Create','0','D2person.PprsPerson module create',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PprsPerson.View','0','D2person.PprsPerson module view',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PprsPerson.Update','0','D2person.PprsPerson module update',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2person.PprsPerson.Delete','0','D2person.PprsPerson module delete',NULL,'N;');
                
            INSERT INTO `authitem` VALUES('D2person.PprsPersonCreate', 2, 'D2person.PprsPerson create', NULL, 'N;');
            INSERT INTO `authitem` VALUES('D2person.PprsPersonUpdate', 2, 'D2person.PprsPerson update', NULL, 'N;');
            INSERT INTO `authitem` VALUES('D2person.PprsPersonDelete', 2, 'D2person.PprsPerson delete', NULL, 'N;');
            INSERT INTO `authitem` VALUES('D2person.PprsPersonView', 2, 'D2person.PprsPerson view', NULL, 'N;');
            
            INSERT INTO `authitemchild` VALUES('D2person.PprsPersonCreate', 'D2person.PprsPerson.Create');
            INSERT INTO `authitemchild` VALUES('D2person.PprsPersonUpdate', 'D2person.PprsPerson.View');
            INSERT INTO `authitemchild` VALUES('D2person.PprsPersonUpdate', 'D2person.PprsPerson.Update');
            INSERT INTO `authitemchild` VALUES('D2person.PprsPersonDelete', 'D2person.PprsPerson.Delete');
            INSERT INTO `authitemchild` VALUES('D2person.PprsPersonView', 'D2person.PprsPerson.View'); 

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
