ALTER TABLE schools
ADD COLUMN `score` INT NOT NULL DEFAULT 0 AFTER `name`,
ADD COLUMN `place` INT NOT NULL DEFAULT 0 AFTER `score`;

ALTER TABLE `score_card_actions`
ADD COLUMN `type` ENUM('TEXT', 'HIDDEN') NOT NULL AFTER `points`,
ADD COLUMN `index` INT NULL AFTER `type`,
DROP COLUMN `field_type`;

ALTER TABLE `teams`
ADD COLUMN `displayed_total` INT NOT NULL DEFAULT 0 AFTER `total`;

ALTER TABLE `scores`
ADD COLUMN `displayed_total` INT NOT NULL DEFAULT 0 AFTER `total`;