DROP TABLE IF EXISTS % prfx % settings;
CREATE TABLE %prfx%settings (
library_name VARCHAR (128) NULL
, library_image_url TEXT NULL
, use_image_flg CHAR (1) NOT NULL
, library_hours VARCHAR (128) NULL
, library_phone VARCHAR (40) NULL
, library_url TEXT NULL
, opac_url TEXT NULL
, session_timeout SMALLINT NOT NULL
, items_per_page TINYINT NOT NULL
, version VARCHAR (10) NOT NULL
, themeid SMALLINT NOT NULL
, purge_history_after_months SMALLINT NOT NULL
, block_checkouts_when_fines_due CHAR (1) NOT NULL
, locale VARCHAR (8) NOT NULL
, CHARSET VARCHAR (20) NULL
, html_lang_attr VARCHAR (8) NULL
)
ENGINE =MyISAM
;
