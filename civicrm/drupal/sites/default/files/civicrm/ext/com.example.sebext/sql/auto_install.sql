CREATE TABLE `civicrm_value_renewals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `contact_id` int(11) NOT NULL DEFAULT '-1',
  `contribution_id` int(11) NOT NULL DEFAULT '-1',
  `membership_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


CREATE TABLE `civicrm_value_renewals_4` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Default MySQL primary key',
  `entity_id` int(10) unsigned NOT NULL COMMENT 'Table that this extends',
  `startdate_7` datetime DEFAULT NULL,
  `enddate_8` datetime DEFAULT NULL,
  `contact_id_9` int(11) DEFAULT NULL,
  `membership_id_10` int(11) DEFAULT NULL,
  `contribution_id_11` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_civicrm_value_renewals_4_entity_id` (`entity_id`),
  KEY `INDEX_startdate_7` (`startdate_7`),
  KEY `INDEX_enddate_8` (`enddate_8`),
  KEY `INDEX_contact_id_9` (`contact_id_9`),
  KEY `INDEX_membership_id_10` (`membership_id_10`),
  KEY `INDEX_contribution_id_11` (`contribution_id_11`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SELECT * FROM civicrm.civicrm_value_renewals_4;