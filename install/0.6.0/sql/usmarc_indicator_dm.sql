DROP TABLE IF EXISTS % prfx % usmarc_indicator_dm;
CREATE TABLE %prfx%usmarc_indicator_dm (
tag SMALLINT NOT NULL
, indicator_nmbr TINYINT NOT NULL
, indicator_cd CHAR (1) NOT NULL
, description VARCHAR (80) NOT NULL
, PRIMARY KEY (tag, indicator_nmbr, indicator_cd)
) ENGINE =MyISAM
;
