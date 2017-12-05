DROP TABLE IF EXISTS % prfx % biblio_copy;
CREATE TABLE %prfx%biblio_copy (
bibid INTEGER NOT NULL
, copyid INTEGER AUTO_INCREMENT NOT NULL
, create_dt DATETIME NOT NULL
, copy_desc VARCHAR (160) NULL
, barcode_nmbr VARCHAR (20) NOT NULL
, status_cd CHAR (3) NOT NULL
, status_begin_dt DATETIME NOT NULL
, due_back_dt DATE NULL
, mbrid INTEGER NULL
, renewal_count TINYINT UNSIGNED NOT NULL
, INDEX barcode_index (barcode_nmbr)
, INDEX mbr_index (mbrid)
, PRIMARY KEY (bibid, copyid)
)
ENGINE =MyISAM
;
