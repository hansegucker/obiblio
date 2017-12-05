DROP TABLE IF EXISTS % prfx % theme;
CREATE TABLE %prfx%theme (
themeid SMALLINT AUTO_INCREMENT PRIMARY KEY
, theme_name VARCHAR (40) NOT NULL
, title_bg VARCHAR (20) NOT NULL
, title_font_face VARCHAR (128) NOT NULL
, title_font_size TINYINT NOT NULL
, title_font_bold CHAR (1) NOT NULL
, title_font_color VARCHAR (20) NOT NULL
, title_align VARCHAR (30) NOT NULL
, primary_bg VARCHAR (20) NOT NULL
, primary_font_face VARCHAR (128) NOT NULL
, primary_font_size TINYINT NOT NULL
, primary_font_color VARCHAR (20) NOT NULL
, primary_link_color VARCHAR (20) NOT NULL
, primary_error_color VARCHAR (20) NOT NULL
, alt1_bg VARCHAR (20) NOT NULL
, alt1_font_face VARCHAR (128) NOT NULL
, alt1_font_size TINYINT NOT NULL
, alt1_font_color VARCHAR (20) NOT NULL
, alt1_link_color VARCHAR (20) NOT NULL
, alt2_bg VARCHAR (20) NOT NULL
, alt2_font_face VARCHAR (128) NOT NULL
, alt2_font_size TINYINT NOT NULL
, alt2_font_color VARCHAR (20) NOT NULL
, alt2_link_color VARCHAR (20) NOT NULL
, alt2_font_bold CHAR (1) NOT NULL
, border_color VARCHAR (20) NOT NULL
, border_width TINYINT NOT NULL
, table_padding TINYINT NOT NULL
)
ENGINE =MyISAM
;
