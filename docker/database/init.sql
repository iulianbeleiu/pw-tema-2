create database evidenta_calculatoare_licente;

CREATE TABLE `evidenta_calculatoare_licente`.`angajat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nume` VARCHAR(15) NULL,
  `prenume` VARCHAR(20) NULL,
  `nr_legitimatie` VARCHAR(6) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

CREATE TABLE `evidenta_calculatoare_licente`.`calculator` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descriere` VARCHAR(40) NULL,
  `nr_inventar` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

CREATE TABLE `evidenta_calculatoare_licente`.`licenta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tip` VARCHAR(45) NULL,
  `produs` VARCHAR(255) NULL,
  `producator` VARCHAR(255) NULL,
  `valoare` INT NULL,
  `document` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

  CREATE TABLE `evidenta_calculatoare_licente`.`angajat_calculator` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_angajat` INT NOT NULL,
  `id_calculator` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_angajat_calculator_1_idx` (`id_angajat` ASC) VISIBLE,
  INDEX `fk_angajat_calculator_2_idx` (`id_calculator` ASC) VISIBLE,
  CONSTRAINT `fk_angajat_calculator_1`
    FOREIGN KEY (`id_angajat`)
    REFERENCES `evidenta_calculatoare_licente`.`angajat` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_angajat_calculator_2`
    FOREIGN KEY (`id_calculator`)
    REFERENCES `evidenta_calculatoare_licente`.`calculator` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


CREATE TABLE `evidenta_calculatoare_licente`.`calculator_licenta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_calculator` INT NOT NULL,
  `id_licenta` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_calculator_licenta_1_idx` (`id_calculator` ASC) VISIBLE,
  INDEX `fk_calculator_licenta_2_idx` (`id_licenta` ASC) VISIBLE,
  CONSTRAINT `fk_calculator_licenta_1`
    FOREIGN KEY (`id_calculator`)
    REFERENCES `evidenta_calculatoare_licente`.`calculator` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calculator_licenta_2`
    FOREIGN KEY (`id_licenta`)
    REFERENCES `evidenta_calculatoare_licente`.`licenta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);