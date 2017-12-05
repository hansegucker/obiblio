DROP TABLE IF EXISTS % prfx % member_fields;
CREATE TABLE %prfx%member_fields (
mbrid INTEGER NOT NULL,
CODE VARCHAR (16) NOT NULL,
DATA TEXT NOT NULL,
PRIMARY KEY (mbrid, CODE ),
INDEX code_index ( CODE )
) ENGINE =MyISAM;
