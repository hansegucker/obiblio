DROP TABLE IF EXISTS % prfx % mbr_classify_dm;
CREATE TABLE %prfx%mbr_classify_dm (
CODE CHAR (1) PRIMARY KEY
, description VARCHAR (40) NOT NULL
, default_flg CHAR (1) NOT NULL
)
ENGINE =MyISAM
;
