DROP TABLE IF EXISTS % prfx % collection_dm;
CREATE TABLE %prfx%collection_dm (
CODE SMALLINT AUTO_INCREMENT PRIMARY KEY
, description VARCHAR (40) NOT NULL
, default_flg CHAR (1) NOT NULL
, days_due_back TINYINT UNSIGNED NOT NULL
, daily_late_fee DECIMAL (4, 2) NOT NULL
)
ENGINE =MyISAM
;
