DROP TABLE IF EXISTS % prfx % mbr_classify_dm;
CREATE TABLE %prfx%mbr_classify_dm (
CODE SMALLINT AUTO_INCREMENT PRIMARY KEY
, description VARCHAR (40) NOT NULL
, default_flg CHAR (1) NOT NULL
, max_fines DECIMAL (4, 2) NOT NULL
)
ENGINE =MyISAM
;
