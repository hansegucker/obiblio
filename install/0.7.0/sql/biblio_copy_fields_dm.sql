DROP TABLE IF EXISTS % prfx % biblio_copy_fields_dm;
CREATE TABLE %prfx%biblio_copy_fields_dm (
CODE VARCHAR (16) NOT NULL,
description CHAR (32) NOT NULL,
default_flg CHAR (1) NOT NULL,
PRIMARY KEY ( CODE )
) ENGINE =MyISAM;
