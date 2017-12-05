DROP TABLE IF EXISTS % prfx % biblio_status_hist;
CREATE TABLE %prfx%biblio_status_hist (
bibid INTEGER NOT NULL
, copyid INTEGER NOT NULL
, status_cd CHAR (3) NOT NULL
, status_begin_dt DATETIME NOT NULL
, due_back_dt DATE NULL
, mbrid INTEGER NULL
, renewal_count TINYINT UNSIGNED NOT NULL
, INDEX mbr_index (mbrid)
, INDEX copy_index (bibid, copyid)
)
ENGINE =MyISAM
;
