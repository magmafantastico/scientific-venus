SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `empreen1_scientific_venus` ;
CREATE SCHEMA IF NOT EXISTS `empreen1_scientific_venus` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `empreen1_scientific_venus` ;

-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`paciente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`paciente` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`paciente` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(10) NOT NULL,
  `nascimento` DATE NOT NULL,
  `religiao` VARCHAR(45) NOT NULL,
  `religiaoNote` VARCHAR(45) NULL,
  `etnia` VARCHAR(45) NOT NULL,
  `etniaNote` VARCHAR(45) NULL,
  `escolaridade` VARCHAR(45) NOT NULL,
  `escolaridadeNote` VARCHAR(45) NULL,
  `estadoCivil` VARCHAR(45) NOT NULL,
  `estadoCivilNote` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`prontuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`prontuario` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`prontuario` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `paciente_id` INT NOT NULL,
  `data` DATE NOT NULL,
  `registro` INT NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `paciente_id_idx` (`paciente_id` ASC),
  CONSTRAINT `paciente_id`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `empreen1_scientific_venus`.`paciente` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`consulta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`consulta` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`consulta` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `prontuario_id` INT NOT NULL,
  `data` DATE NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_consulta_1_idx` (`prontuario_id` ASC),
  CONSTRAINT `fk_consulta_1`
    FOREIGN KEY (`prontuario_id`)
    REFERENCES `empreen1_scientific_venus`.`prontuario` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`exameFisico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`exameFisico` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`exameFisico` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `consulta_id` INT NOT NULL,
  `peso` FLOAT NULL,
  `altura` FLOAT NULL,
  `imc` FLOAT NULL,
  `pressaoArterial` VARCHAR(45) NULL,
  `circunferenciaAbdominal` VARCHAR(45) NULL,
  `circunferenciaCervical` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_exameFisico_1_idx` (`consulta_id` ASC),
  CONSTRAINT `fk_exameFisico_1`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `empreen1_scientific_venus`.`consulta` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`antecedentes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`antecedentes` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`antecedentes` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `consulta_id` INT NOT NULL,
  `situacaoAborto` TINYINT(1) NULL,
  `situacaoGestacao` TINYINT(1) NULL,
  `situacaoParidade` TINYINT(1) NULL,
  `tabagismo` TINYINT(1) NULL,
  `hac` TINYINT(1) NULL,
  `hacType` VARCHAR(45) NULL,
  `diabetes` TINYINT(1) NULL,
  `diabetesType` VARCHAR(45) NULL,
  `hipotireoidismo` TINYINT(1) NULL,
  `hipotireoidismoType` VARCHAR(45) NULL,
  `note` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_antecedentes_1_idx` (`consulta_id` ASC),
  CONSTRAINT `fk_antecedentes_1`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `empreen1_scientific_venus`.`consulta` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`ultrassom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`ultrassom` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`ultrassom` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `consulta_id` INT NOT NULL,
  `volumeUterino` FLOAT NULL,
  `ovarioDireito` FLOAT NULL,
  `ovarioEsquerdo` FLOAT NULL,
  `endometro` FLOAT NULL,
  `nd` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_ultrassom_1_idx` (`consulta_id` ASC),
  CONSTRAINT `fk_ultrassom_1`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `empreen1_scientific_venus`.`consulta` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`escalas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`escalas` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`escalas` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `consulta_id` INT NOT NULL,
  `pbacInicial` VARCHAR(45) NULL,
  `beckInicial` VARCHAR(45) NULL,
  `vidaMioma` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_escalas_1_idx` (`consulta_id` ASC),
  CONSTRAINT `fk_escalas_1`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `empreen1_scientific_venus`.`consulta` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`exames`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`exames` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`exames` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `consulta_id` INT NOT NULL,
  `hb` FLOAT NULL,
  `ht` FLOAT NULL,
  `vcm` FLOAT NULL,
  `rdw` FLOAT NULL,
  `ferro` FLOAT NULL,
  `ferritina` FLOAT NULL,
  `vitaminaD3` FLOAT NULL,
  `gj` FLOAT NULL,
  `ct` FLOAT NULL,
  `ldl` FLOAT NULL,
  `hdl` FLOAT NULL,
  `tsh` FLOAT NULL,
  `t4l` FLOAT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_exames_1_idx` (`consulta_id` ASC),
  CONSTRAINT `fk_exames_1`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `empreen1_scientific_venus`.`consulta` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`conduta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`conduta` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`conduta` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `consulta_id` INT NOT NULL,
  `conduta` VARCHAR(45) NULL,
  `cirurgia` VARCHAR(45) NULL,
  `hormonioTerapia` VARCHAR(45) NULL,
  `hormonioTerapiaAINH` VARCHAR(45) NULL,
  `hormonioTerapiaCiclico` TINYINT(1) NULL,
  `hormonioTerapiaContinuo` TINYINT(1) NULL,
  `hormonioTerapiaNome` VARCHAR(45) NULL,
  `ainh` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_conduta_1_idx` (`consulta_id` ASC),
  CONSTRAINT `fk_conduta_1`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `empreen1_scientific_venus`.`consulta` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`resultados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`resultados` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`resultados` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `consulta_id` INT NOT NULL,
  `pbacFinal` VARCHAR(45) NULL,
  `beckFinal` VARCHAR(45) NULL,
  `vidaMioma` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_resultados_1_idx` (`consulta_id` ASC),
  CONSTRAINT `fk_resultados_1`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `empreen1_scientific_venus`.`consulta` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`mioma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`mioma` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`mioma` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `consulta_id` INT NOT NULL,
  `medida` FLOAT NULL,
  `tipo` VARCHAR(45) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`),
  INDEX `fk_mioma_1_idx` (`consulta_id` ASC),
  CONSTRAINT `fk_mioma_1`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `empreen1_scientific_venus`.`consulta` (`_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empreen1_scientific_venus`.`log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empreen1_scientific_venus`.`log` ;

CREATE TABLE IF NOT EXISTS `empreen1_scientific_venus`.`log` (
  `_id` INT NULL AUTO_INCREMENT,
  `agent` VARCHAR(180) NOT NULL,
  `time` VARCHAR(45) NOT NULL,
  `timezone` INT NOT NULL,
  `ip` VARCHAR(45) NOT NULL,
  `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
