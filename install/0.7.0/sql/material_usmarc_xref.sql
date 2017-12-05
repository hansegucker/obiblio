DROP TABLE IF EXISTS % prfx % material_usmarc_xref;
CREATE TABLE %prfx%material_usmarc_xref (
`xref_id` INT (11) NOT NULL AUTO_INCREMENT,
`materialCd` INT (11) NOT NULL DEFAULT '0',
`tag` CHAR (3) NOT NULL DEFAULT '',
`subfieldCd` CHAR (1) NOT NULL DEFAULT '',
`descr` VARCHAR (64) NOT NULL DEFAULT '',
`required` CHAR (1) NOT NULL DEFAULT '',
`cntrltype` CHAR (1) NOT NULL DEFAULT '',
PRIMARY KEY (`xref_id`)
) ENGINE =MyISAM;
