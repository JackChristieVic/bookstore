-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema id10149432_bookstore
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema id10149432_bookstore
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `id10149432_bookstore` DEFAULT CHARACTER SET utf8 ;
USE `id10149432_bookstore` ;

-- -----------------------------------------------------
-- Table `id10149432_bookstore`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id10149432_bookstore`.`customer` (
  `customer_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `user_name` VARCHAR(15) NOT NULL,
  `password_1` VARCHAR(255) NOT NULL,
  `password_2` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(15) NOT NULL,
  `last_name` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE INDEX `CUSTOMER_ID_UNIQUE` (`customer_id` ASC),
  UNIQUE INDEX `EMAIL_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id10149432_bookstore`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id10149432_bookstore`.`products` (
  `product_id` INT NOT NULL AUTO_INCREMENT,
  `price` INT NOT NULL,
  `product_name` VARCHAR(45) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `product_img_dir` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id10149432_bookstore`.`cart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id10149432_bookstore`.`cart` (
  `customer_customer_id` INT NOT NULL,
  `products_product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`customer_customer_id`, `products_product_id`),
  INDEX `fk_CART_PRODUCTS1_idx` (`products_product_id` ASC),
  CONSTRAINT `fk_CART_CUSTOMER1`
    FOREIGN KEY (`customer_customer_id`)
    REFERENCES `id10149432_bookstore`.`customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CART_PRODUCTS1`
    FOREIGN KEY (`products_product_id`)
    REFERENCES `id10149432_bookstore`.`products` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id10149432_bookstore`.`order_history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id10149432_bookstore`.`order_history` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `products_product_id` INT NOT NULL,
  `customer_customer_id` INT NOT NULL,
  PRIMARY KEY (`order_id`),
  INDEX `fk_ORDER_HISTORY_PRODUCTS_idx` (`products_product_id` ASC),
  INDEX `fk_ORDER_HISTORY_CUSTOMER1_idx` (`customer_customer_id` ASC),
  CONSTRAINT `fk_ORDER_HISTORY_PRODUCTS`
    FOREIGN KEY (`products_product_id`)
    REFERENCES `id10149432_bookstore`.`products` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ORDER_HISTORY_CUSTOMER1`
    FOREIGN KEY (`customer_customer_id`)
    REFERENCES `id10149432_bookstore`.`customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id10149432_bookstore`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id10149432_bookstore`.`categories` (
  `categorie_id` INT NOT NULL AUTO_INCREMENT,
  `categorie_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`categorie_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `id10149432_bookstore`.`prod_cat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id10149432_bookstore`.`prod_cat` (
  `products_product_id` INT NOT NULL,
  `categories_categorie_id` INT NOT NULL,
  PRIMARY KEY (`products_product_id`, `categories_categorie_id`),
  INDEX `fk_PROD_CAT_CATEGORIES1_idx` (`categories_categorie_id` ASC),
  CONSTRAINT `fk_PROD_CAT_PRODUCTS1`
    FOREIGN KEY (`products_product_id`)
    REFERENCES `id10149432_bookstore`.`products` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PROD_CAT_CATEGORIES1`
    FOREIGN KEY (`categories_categorie_id`)
    REFERENCES `id10149432_bookstore`.`categories` (`categorie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
