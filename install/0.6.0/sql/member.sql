DROP TABLE IF EXISTS % prfx % member;
CREATE TABLE %prfx%member (
mbrid INTEGER AUTO_INCREMENT PRIMARY KEY
, barcode_nmbr VARCHAR (20) NOT NULL
, create_dt DATETIME NOT NULL
, last_change_dt DATETIME NOT NULL
, last_change_userid INTEGER NOT NULL
, last_name VARCHAR (50) NOT NULL
, first_name VARCHAR (50) NOT NULL
, address TEXT NULL
, home_phone VARCHAR (15) NULL
, work_phone VARCHAR (15) NULL
, email VARCHAR (128) NULL
, classification SMALLINT NOT NULL
, mbrshipend DATE NOT NULL
)
ENGINE =MyISAM
;
