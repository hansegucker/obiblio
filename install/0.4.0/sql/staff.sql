DROP TABLE IF EXISTS % prfx % staff;
CREATE TABLE %prfx%staff (
userid INTEGER AUTO_INCREMENT PRIMARY KEY
, create_dt DATETIME NOT NULL
, last_change_dt DATETIME NOT NULL
, last_change_userid INTEGER NOT NULL
, username VARCHAR (20) NOT NULL
, pwd VARCHAR (20) NOT NULL
, last_name VARCHAR (30) NOT NULL
, first_name VARCHAR (30) NULL
, suspended_flg CHAR (1) NOT NULL
, admin_flg CHAR (1) NOT NULL
, circ_flg CHAR (1) NOT NULL
, circ_mbr_flg CHAR (1) NOT NULL
, catalog_flg CHAR (1) NOT NULL
, reports_flg CHAR (1) NOT NULL
)
ENGINE =MyISAM
;
