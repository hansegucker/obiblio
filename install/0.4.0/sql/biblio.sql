DROP TABLE IF EXISTS % prfx % biblio;
CREATE TABLE %prfx%biblio (
bibid INTEGER AUTO_INCREMENT PRIMARY KEY
, create_dt DATETIME NOT NULL
, last_change_dt DATETIME NOT NULL
, last_change_userid INTEGER NOT NULL
, material_cd SMALLINT NOT NULL
, collection_cd SMALLINT NOT NULL
, call_nmbr1 VARCHAR (20) NULL
, call_nmbr2 VARCHAR (20) NULL
, call_nmbr3 VARCHAR (20) NULL
, title TEXT NULL
, title_remainder TEXT NULL
, responsibility_stmt TEXT NULL
, author TEXT NULL
, topic1 TEXT NULL
, topic2 TEXT NULL
, topic3 TEXT NULL
, topic4 TEXT NULL
, topic5 TEXT NULL
, opac_flg CHAR (1) NOT NULL
)
ENGINE =MyISAM
;
