SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `lisdcs_uil` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `lisdcs_uil` ;

-- -----------------------------------------------------
-- Table `lisdcs_uil`.`teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`teams` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`teams` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `type` VARCHAR(4) NOT NULL ,
  `total` INT NULL DEFAULT 0 ,
  `place` INT NULL DEFAULT -1 ,
  `school` VARCHAR(512) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `lisdcs_uil`.`score_card_actions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`score_card_actions` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`score_card_actions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `score_card_id` INT NOT NULL ,
  `action` VARCHAR(512) NOT NULL ,
  `points` VARCHAR(1024) NOT NULL ,
  `field_type` ENUM('TEXT', 'CHECKBOX') NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `lisdcs_uil`.`score_cards`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`score_cards` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`score_cards` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(128) NOT NULL ,
  `locked` TINYINT(1)  NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_score_cards_score_card_actions1`
    FOREIGN KEY (`id` )
    REFERENCES `lisdcs_uil`.`score_card_actions` (`score_card_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `lisdcs_uil`.`scores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`scores` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`scores` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `team_id` INT NOT NULL ,
  `score_card_id` INT NOT NULL ,
  `round` INT NOT NULL ,
  `total` INT NOT NULL ,
  `isrunoff` TINYINT(1)  NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_scores_teams` (`team_id` ASC) ,
  CONSTRAINT `fk_scores_teams`
    FOREIGN KEY (`team_id` )
    REFERENCES `lisdcs_uil`.`teams` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_scores_score_cards1`
    FOREIGN KEY (`id` )
    REFERENCES `lisdcs_uil`.`score_cards` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `lisdcs_uil`.`fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`fields` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`fields` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `score_id` INT NOT NULL ,
  `field_name` VARCHAR(60) NOT NULL ,
  `total` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_fields_scores1` (`score_id` ASC) ,
  CONSTRAINT `fk_fields_scores1`
    FOREIGN KEY (`score_id` )
    REFERENCES `lisdcs_uil`.`scores` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `lisdcs_uil`.`app_config`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`app_config` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`app_config` (
  `var` VARCHAR(40) NOT NULL ,
  `value` TEXT NOT NULL ,
  PRIMARY KEY (`var`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `lisdcs_uil`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`users` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(120) NOT NULL ,
  `account_type` TINYINT(1)  NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `lisdcs_uil`.`team_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`team_types` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`team_types` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(4) NOT NULL ,
  `nice_name` VARCHAR(128) NOT NULL ,
  `score_card` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_team_types_teams1` (`type` ASC) ,
  INDEX `fk_team_types_score_cards1` (`score_card` ASC) ,
  CONSTRAINT `fk_team_types_teams1`
    FOREIGN KEY (`type` )
    REFERENCES `lisdcs_uil`.`teams` (`type` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_team_types_score_cards1`
    FOREIGN KEY (`score_card` )
    REFERENCES `lisdcs_uil`.`score_cards` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `lisdcs_uil`.`score_debug_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lisdcs_uil`.`score_debug_log` ;

CREATE  TABLE IF NOT EXISTS `lisdcs_uil`.`score_debug_log` (
  `id` INT NOT NULL ,
  `datetime` DATETIME NOT NULL ,
  `output` TEXT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
