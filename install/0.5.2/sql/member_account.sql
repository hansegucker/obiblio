DROP TABLE IF EXISTS % prfx % member_account;
CREATE TABLE %prfx%member_account (
mbrid INTEGER NOT NULL
, transid INTEGER AUTO_INCREMENT NOT NULL
, create_dt DATETIME NOT NULL
, create_userid INTEGER NOT NULL
, transaction_type_cd CHAR (2) NOT NULL
, amount DECIMAL (8, 2) NOT NULL
, description VARCHAR (128) NULL
, PRIMARY KEY (mbrid, transid)
)
ENGINE =MyISAM
;
