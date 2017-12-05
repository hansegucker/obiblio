DROP TABLE IF EXISTS % prfx % usmarc_subfield_dm;
CREATE TABLE %prfx%usmarc_subfield_dm (
tag SMALLINT NOT NULL
, subfield_cd CHAR (1) NOT NULL
, description VARCHAR (80) NOT NULL
, repeatable_flg CHAR (1) NOT NULL
, PRIMARY KEY (tag, subfield_cd)
) ENGINE =MyISAM
;
