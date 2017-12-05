DROP TABLE IF EXISTS % prfx % biblio_copy_fields;
CREATE TABLE %prfx%biblio_copy_fields (
bibid INTEGER NOT NULL,
copyid INTEGER NOT NULL,
CODE VARCHAR (16) NOT NULL,
DATA TEXT NOT NULL,
PRIMARY KEY (bibid, copyid, CODE ),
INDEX code_index ( CODE )
) ENGINE =MyISAM;
