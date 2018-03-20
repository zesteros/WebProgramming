-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema electronica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema electronica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `electronica` DEFAULT CHARACTER SET utf8 ;
USE `electronica` ;

-- -----------------------------------------------------
-- Table `electronica`.`store`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `electronica`.`store` (
  `id_store` DECIMAL(10,0) NOT NULL,
  `id_location` DECIMAL(10,0) NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id_store`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `electronica`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `electronica`.`products` (
  `id_product` DECIMAL(10,0) NOT NULL,
  `id_store` DECIMAL(10,0) NULL,
  `description` VARCHAR(100) NULL,
  `stock` INT(11) NULL DEFAULT NULL,
  `price` FLOAT NULL DEFAULT NULL,
  `public_price` FLOAT NULL,
  PRIMARY KEY (`id_product`),
  INDEX `id_store_idx` (`id_store` ASC),
  CONSTRAINT `id_store`
    FOREIGN KEY (`id_store`)
    REFERENCES `electronica`.`store` (`id_store`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `electronica`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `electronica`.`user` (
  `id_user` DECIMAL(10,0) NOT NULL,
  `firstname` VARCHAR(50) NULL DEFAULT NULL,
  `lastname` VARCHAR(50) NULL DEFAULT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `date_birth` DATE NULL DEFAULT NULL,
  `phone` DECIMAL(10,0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `electronica`.`customers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `electronica`.`customers` (
  `id_customer` DECIMAL(10,0) NOT NULL,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `date_birth` VARCHAR(45) NULL,
  `phone` DECIMAL(10,0) NULL,
  PRIMARY KEY (`id_customer`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `electronica`.`sales_by_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `electronica`.`sales_by_user` (
  `id_sale` DECIMAL(10,0) NOT NULL,
  `id_user` DECIMAL(10,0) NULL,
  `date` DATETIME NULL,
  `id_customer` DECIMAL(10,0) NULL,
  PRIMARY KEY (`id_sale`),
  INDEX `id_user_idx` (`id_user` ASC),
  CONSTRAINT `id_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `electronica`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_customer`
    FOREIGN KEY ()
    REFERENCES `electronica`.`customers` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `electronica`.`sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `electronica`.`sales` (
  `id_sale` DECIMAL(10,0) NULL,
  `id_product` DECIMAL(10,0) NULL,
  `amount` INT(11) NULL,
  INDEX `id_product_idx` (`id_product` ASC),
  CONSTRAINT `id_sale`
    FOREIGN KEY (`id_sale`)
    REFERENCES `electronica`.`sales_by_user` (`id_sale`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_product`
    FOREIGN KEY (`id_product`)
    REFERENCES `electronica`.`products` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `electronica`.`user_pass`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `electronica`.`user_pass` (
  `id_user` DECIMAL(10,0) NOT NULL,
  `user_type` CHAR(1) NULL DEFAULT NULL,
  `username` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(50) NULL DEFAULT NULL,
  `login_session` VARCHAR(200) NULL,
  PRIMARY KEY (`id_user`),
  CONSTRAINT `id_user`
    FOREIGN KEY ()
    REFERENCES `electronica`.`user` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `electronica`.`attendant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `electronica`.`attendant` (
  `id_user` DECIMAL(10,0) NOT NULL,
  `id_store` DECIMAL(10,0) NOT NULL,
  PRIMARY KEY (`id_user`, `id_store`),
  CONSTRAINT `id_user`
    FOREIGN KEY ()
    REFERENCES `electronica`.`user` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_store`
    FOREIGN KEY ()
    REFERENCES `electronica`.`store` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
