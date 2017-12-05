DROP TABLE IF EXISTS % prfx % member;
CREATE TABLE %prfx%member (
mbrid INTEGER AUTO_INCREMENT PRIMARY KEY
, barcode_nmbr VARCHAR (20) NOT NULL
, create_dt DATETIME NOT NULL
, last_change_dt DATETIME NOT NULL
, last_change_userid INTEGER NOT NULL
, last_name VARCHAR (50) NOT NULL
, first_name VARCHAR (50) NOT NULL
, address1 VARCHAR (128) NULL
, address2 VARCHAR (128) NULL
, city VARCHAR (50) NULL
, state CHAR (2) NULL
, zip MEDIUMINT NULL
, zip_ext SMALLINT NULL
, home_phone VARCHAR (15) NULL
, work_phone VARCHAR (15) NULL
, email VARCHAR (128) NULL
, classification CHAR (1) NOT NULL
, school_grade TINYINT NULL
, school_teacher VARCHAR (50) NULL
, mbrshipend DATE NOT NULL
)
ENGINE =MyISAM
;
