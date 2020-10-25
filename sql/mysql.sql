CREATE TABLE `clientspace_cat` (
    `cat_id`     SMALLINT(3)  NOT NULL AUTO_INCREMENT,
    `cat_weight` MEDIUMINT(3) NOT NULL DEFAULT '0',
    `cat_img`    VARCHAR(255) NOT NULL DEFAULT '',
    `cat_title`  VARCHAR(255) NOT NULL DEFAULT '',
    `cat_desc`   TEXT         NOT NULL,
    PRIMARY KEY (`cat_id`)
);



CREATE TABLE `clientspace_items` (
    `item_id`    MEDIUMINT(8) NOT NULL AUTO_INCREMENT,
    `cat_id`     SMALLINT(3)  NOT NULL DEFAULT '0',
    `item_desc`  TEXT         NOT NULL,
    `item_date`  DATE         NOT NULL DEFAULT '0000-00-00',
    `item_ext`   VARCHAR(4)   NOT NULL DEFAULT '',
    `item_title` VARCHAR(255) NOT NULL DEFAULT '',
    `item_type`  VARCHAR(255) NOT NULL DEFAULT '',
    `uid`        MEDIUMINT(8) NOT NULL DEFAULT '0',
    `item_lect`  TINYINT(1)   NOT NULL DEFAULT '0',
    `item_size`  INT(11)      NOT NULL DEFAULT '0',
    PRIMARY KEY (`item_id`)
);



CREATE TABLE `clientspace_suivi` (
    `suivi_id`      MEDIUMINT(8) NOT NULL AUTO_INCREMENT,
    `uid`           MEDIUMINT(8) NOT NULL DEFAULT '0',
    `suivi_title`   VARCHAR(255) NOT NULL DEFAULT '',
    `suivi_date`    DATE         NOT NULL DEFAULT '0000-00-00',
    `suivi_content` TEXT         NOT NULL,
    `suivi_lect`    SMALLINT(1)  NOT NULL DEFAULT '0',
    `suivi_desc`    TEXT         NOT NULL,
    PRIMARY KEY (`suivi_id`)
);



