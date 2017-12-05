DROP TABLE IF EXISTS % prfx % biblio_field;
CREATE TABLE %prfx%biblio_field (
bibid INTEGER NOT NULL
, fieldid INTEGER AUTO_INCREMENT NOT NULL
, tag SMALLINT NOT NULL
, ind1_cd CHAR (1) NULL
, ind2_cd CHAR (1) NULL
, subfield_cd CHAR (1) NOT NULL
, field_data TEXT NULL
, PRIMARY KEY (bibid, fieldid)
)
ENGINE =MyISAM
;
