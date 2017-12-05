DROP TABLE IF EXISTS % prfx % material_type_dm;
CREATE TABLE %prfx%material_type_dm (
CODE SMALLINT AUTO_INCREMENT PRIMARY KEY
, description VARCHAR (40) NOT NULL
, default_flg CHAR (1) NOT NULL
, adult_checkout_limit TINYINT UNSIGNED NOT NULL
, juvenile_checkout_limit TINYINT UNSIGNED NOT NULL
, image_file VARCHAR (128) NULL
)
ENGINE =MyISAM
;
