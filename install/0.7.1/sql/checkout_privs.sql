DROP TABLE IF EXISTS % prfx % checkout_privs;
CREATE TABLE %prfx%checkout_privs (
material_cd SMALLINT NOT NULL,
classification SMALLINT NOT NULL,
checkout_limit TINYINT UNSIGNED NOT NULL,
renewal_limit TINYINT UNSIGNED NOT NULL,
PRIMARY KEY (material_cd, classification)
)
ENGINE =MyISAM
;
