-- -----------------------------------------------------
-- Table `schools`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `schools` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(128) NOT NULL ,
  `score` INT NOT NULL DEFAULT 0,
  `place` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `score_card_actions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `score_card_actions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `score_card_id` INT NOT NULL ,
  `action` VARCHAR(512) NOT NULL ,
  `points` VARCHAR(1024) NOT NULL ,
  `type` ENUM('TEXT', 'HIDDEN') NOT NULL ,
  `index` INT NULL,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `score_cards`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `score_cards` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(128) NOT NULL ,
  `locked` TINYINT(1)  NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_score_cards_score_card_actions1`
    FOREIGN KEY (`id` )
    REFERENCES `score_card_actions` (`score_card_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `team_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `team_types` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nice_name` VARCHAR(128) NOT NULL ,
  `score_card` INT NOT NULL ,
  `hidden` TINYINT(1)  NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_team_types_score_cards1` (`score_card` ASC) ,
  CONSTRAINT `fk_team_types_score_cards1`
    FOREIGN KEY (`score_card` )
    REFERENCES `score_cards` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `teams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `teams` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `first_name` VARCHAR(128) NOT NULL ,
  `last_name` VARCHAR(128) NOT NULL ,
  `type` INT NOT NULL ,
  `school_id` INT NOT NULL ,
  `total` INT NULL DEFAULT 0 ,
  `displayed_total` INT NOT NULL DEFAULT 0,
  `place` INT NULL DEFAULT -1 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_teams_schools1` (`school_id` ASC) ,
  INDEX `fk_teams_team_types1` (`type` ASC) ,
  CONSTRAINT `fk_teams_schools1`
    FOREIGN KEY (`school_id` )
    REFERENCES `schools` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teams_team_types1`
    FOREIGN KEY (`type` )
    REFERENCES `team_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `scores`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `scores` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `team_id` INT NOT NULL ,
  `score_card_id` INT NOT NULL ,
  `round` INT NOT NULL ,
  `total` INT NOT NULL ,
  `displayed_total` INT NULL,
  `isrunoff` TINYINT(1)  NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_scores_teams` (`team_id` ASC) ,
  CONSTRAINT `fk_scores_teams`
    FOREIGN KEY (`team_id` )
    REFERENCES `teams` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_scores_score_cards1`
    FOREIGN KEY (`id` )
    REFERENCES `score_cards` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `fields`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fields` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `score_id` INT NOT NULL ,
  `field_name` VARCHAR(60) NOT NULL ,
  `total` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_fields_scores1` (`score_id` ASC) ,
  CONSTRAINT `fk_fields_scores1`
    FOREIGN KEY (`score_id` )
    REFERENCES `scores` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `app_config`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `app_config` (
  `var` VARCHAR(40) NOT NULL ,
  `value` TEXT NOT NULL ,
  PRIMARY KEY (`var`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `user_links`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user_links` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `type` ENUM('TEAM') NOT NULL ,
  `object_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(120) NOT NULL ,
  `account_type` ENUM('PARENT', 'ACCT_CREATOR', 'ADMIN') NOT NULL DEFAULT 'ADMIN' ,
  `created_by` INT NOT NULL DEFAULT -1 ,
  `school_limit` INT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_users_user_links1`
    FOREIGN KEY (`id` )
    REFERENCES `user_links` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `score_debug_log`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `score_debug_log` (
  `id` INT NOT NULL ,
  `datetime` DATETIME NOT NULL ,
  `output` TEXT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;
