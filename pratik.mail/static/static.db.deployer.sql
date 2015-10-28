SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';




CREATE  TABLE IF NOT EXISTS `mail` (
  `idmail` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(255) NULL ,
  `objet` VARCHAR(255) NULL ,
  `texte` TEXT NULL ,
  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
  PRIMARY KEY (`idmail`) )
ENGINE = MyISAM;

INSERT INTO `mail` VALUES (NULL,'alert','Alerte','Un changement a été effectué sur le site. Connectez-vous!','fr_fr');






SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;