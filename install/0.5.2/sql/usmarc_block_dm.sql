DROP TABLE IF EXISTS % prfx % usmarc_block_dm;
CREATE TABLE %prfx%usmarc_block_dm (
block_nmbr TINYINT PRIMARY KEY
, description VARCHAR (80) NOT NULL
)
ENGINE =MyISAM
;
