DROP TABLE IF EXISTS % prfx % biblio_hold;
CREATE TABLE %prfx%biblio_hold (
bibid INTEGER NOT NULL
, copyid INTEGER NOT NULL
, holdid INTEGER AUTO_INCREMENT NOT NULL
, hold_begin_dt DATETIME NOT NULL
, mbrid INTEGER NOT NULL
, INDEX mbr_index (mbrid)
, PRIMARY KEY (bibid, copyid, holdid)
)
ENGINE =MyISAM
;
