SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `scientific_venus` ;
CREATE SCHEMA IF NOT EXISTS `scientific_venus` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `scientific_venus` ;

-- -----------------------------------------------------
-- Table `scientific_venus`.`paciente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scientific_venus`.`paciente` ;

CREATE TABLE IF NOT EXISTS `scientific_venus`.`paciente` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(10) NOT NULL,
  `nascimento` DATE NOT NULL,
  `religiao` VARCHAR(45) NOT NULL,
  `religiaoNote` VARCHAR(45) NULL,
  `etnia` VARCHAR(45) NOT NULL,
  `etiniaNote` VARCHAR(45) NULL,
  `escolaridade` VARCHAR(45) NOT NULL,
  `escolaridadeNote` VARCHAR(45) NULL,
  `estadoCivil` VARCHAR(45) NOT NULL,
  `estadoCivilNote` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scientific_venus`.`prontuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scientific_venus`.`prontuario` ;

CREATE TABLE IF NOT EXISTS `scientific_venus`.`prontuario` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `paciente_id` INT NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `paciente_id_idx` (`paciente_id` ASC),
  CONSTRAINT `paciente_id`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `scientific_venus`.`paciente` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scientific_venus`.`exameFisico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scientific_venus`.`exameFisico` ;

CREATE TABLE IF NOT EXISTS `scientific_venus`.`exameFisico` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `prontuario_id` INT NOT NULL,
  `peso` DECIMAL(6,2) NULL,
  `altura` DECIMAL(6,2) NULL,
  `imc` DECIMAL(6,2) NULL,
  `pressaoArterial` DECIMAL(6,2) NULL,
  `circunferenciaAbdominal` DECIMAL(6,2) NULL,
  `circunferenciaCervical` DECIMAL(6,2) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `prontuario_id_idx` (`prontuario_id` ASC),
  CONSTRAINT `prontuario_id`
    FOREIGN KEY (`prontuario_id`)
    REFERENCES `scientific_venus`.`prontuario` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scientific_venus`.`antecedentes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scientific_venus`.`antecedentes` ;

CREATE TABLE IF NOT EXISTS `scientific_venus`.`antecedentes` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `prontuario_id` INT NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `prontuario_id_idx` (`prontuario_id` ASC),
  CONSTRAINT `prontuario_id0`
    FOREIGN KEY (`prontuario_id`)
    REFERENCES `scientific_venus`.`prontuario` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
