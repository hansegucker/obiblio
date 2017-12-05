DROP TABLE IF EXISTS % prfx % biblio_status_dm;
CREATE TABLE %prfx%biblio_status_dm (
CODE CHAR (3) PRIMARY KEY
, description VARCHAR (40) NOT NULL
, default_flg CHAR (1) NOT NULL
)
ENGINE =MyISAM
;
