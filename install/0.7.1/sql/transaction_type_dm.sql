DROP TABLE IF EXISTS % prfx % transaction_type_dm;
CREATE TABLE %prfx%transaction_type_dm (
CODE CHAR (2) PRIMARY KEY
, description VARCHAR (40) NOT NULL
, default_flg CHAR (1) NOT NULL
)
ENGINE =MyISAM
;
