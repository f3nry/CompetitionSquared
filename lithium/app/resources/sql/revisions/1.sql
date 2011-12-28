ALTER TABLE `score_card_actions`
ADD INDEX `fk_score_card_actions_score_cards` (`score_card_id` ASC) ;

ALTER TABLE `scores`
ADD INDEX `fk_scores_score_cards1` (`score_card_id` ASC) ;

ALTER TABLE `teams` ADD COLUMN `hidden_total` INT(11) NULL DEFAULT NULL  AFTER `total` ;

ALTER TABLE `user_links`
  ADD CONSTRAINT `fk_user_links_users1`
  FOREIGN KEY (`user_id` )
  REFERENCES `users` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_user_links_users1` (`user_id` ASC) ;