DROP TABLE IF EXISTS % prfx % usmarc_tag_dm;
CREATE TABLE %prfx%usmarc_tag_dm (
block_nmbr TINYINT NOT NULL
, tag SMALLINT NOT NULL
, description VARCHAR (80) NOT NULL
, ind1_description VARCHAR (80) NOT NULL
, ind2_description VARCHAR (80) NOT NULL
, repeatable_flg CHAR (1) NOT NULL
, PRIMARY KEY (block_nmbr, tag)
) ENGINE =MyISAM
;
