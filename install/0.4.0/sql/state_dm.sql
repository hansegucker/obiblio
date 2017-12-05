DROP TABLE IF EXISTS % prfx % state_dm;
CREATE TABLE %prfx%state_dm (
CODE CHAR (2) PRIMARY KEY
, description VARCHAR (20) NOT NULL
, default_flg CHAR (1) NOT NULL
)
ENGINE =MyISAM
;
