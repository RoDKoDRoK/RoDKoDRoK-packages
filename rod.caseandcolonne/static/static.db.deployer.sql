SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



CREATE  TABLE IF NOT EXISTS `colonne` (
  `idcolonne` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nomcodecolonne` VARCHAR(255) NULL ,
  `nomcolonne` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`idcolonne`,`nomcodecolonne`) )
ENGINE = MyISAM;


CREATE  TABLE IF NOT EXISTS `colonne_has_case` (
  `idcolonne` BIGINT UNSIGNED NOT NULL ,
  `idcase` BIGINT UNSIGNED NOT NULL ,
  `ordre` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idcolonne`,`idcase`) )
ENGINE = MyISAM;


CREATE  TABLE IF NOT EXISTS `case` (
  `idcase` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nomcodecase` VARCHAR(255) NULL ,
  `nomcase` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`idcase`,`nomcodecase`) )
ENGINE = MyISAM;








SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;