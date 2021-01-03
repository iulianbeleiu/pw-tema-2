
1/2.

create database gestiune_angajat_calculator_licente;

CREATE TABLE `gestiune_angajat_calculator_licente`.`angajat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nume` VARCHAR(15) NULL,
  `prenume` VARCHAR(20) NULL,
  `nr_legitimatie` VARCHAR(6) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

CREATE TABLE `gestiune_angajat_calculator_licente`.`calculator` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descriere` VARCHAR(40) NULL,
  `nr_inventar` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

CREATE TABLE `gestiune_angajat_calculator_licente`.`licenta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tip` VARCHAR(45) NULL,
  `produs` VARCHAR(255) NULL,
  `producator` VARCHAR(255) NULL,
  `valoare` INT NULL,
  `document` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

  CREATE TABLE `gestiune_angajat_calculator_licente`.`angajat_calculator` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_angajat` INT NOT NULL,
  `id_calculator` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_angajat_calculator_1_idx` (`id_angajat` ASC) VISIBLE,
  INDEX `fk_angajat_calculator_2_idx` (`id_calculator` ASC) VISIBLE,
  CONSTRAINT `fk_angajat_calculator_1`
    FOREIGN KEY (`id_angajat`)
    REFERENCES `gestiune_angajat_calculator_licente`.`angajat` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_angajat_calculator_2`
    FOREIGN KEY (`id_calculator`)
    REFERENCES `gestiune_angajat_calculator_licente`.`calculator` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


CREATE TABLE `gestiune_angajat_calculator_licente`.`calculator_licenta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_calculator` INT NOT NULL,
  `id_licenta` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_calculator_licenta_1_idx` (`id_calculator` ASC) VISIBLE,
  INDEX `fk_calculator_licenta_2_idx` (`id_licenta` ASC) VISIBLE,
  CONSTRAINT `fk_calculator_licenta_1`
    FOREIGN KEY (`id_calculator`)
    REFERENCES `gestiune_angajat_calculator_licente`.`calculator` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calculator_licenta_2`
    FOREIGN KEY (`id_licenta`)
    REFERENCES `gestiune_angajat_calculator_licente`.`licenta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


3.
INSERT INTO `gestiune_angajat_calculator_licente`.`angajat` (`nume`, `prenume`, `nr_legitimatie`) VALUES ('popa', 'ion', '123456');
INSERT INTO `gestiune_angajat_calculator_licente`.`angajat` (`nume`, `prenume`, `nr_legitimatie`) VALUES ('adam', 'gheorghe', '123457');
INSERT INTO `gestiune_angajat_calculator_licente`.`angajat` (`nume`, `prenume`, `nr_legitimatie`) VALUES ('Pop', 'george', '123458');


INSERT INTO `gestiune_angajat_calculator_licente`.`calculator` (`descriere`, `nr_inventar`) VALUES ('Pentium 4', '1000');
INSERT INTO `gestiune_angajat_calculator_licente`.`calculator` (`descriere`, `nr_inventar`) VALUES ('Athlon', '1001');
INSERT INTO `gestiune_angajat_calculator_licente`.`calculator` (`descriere`, `nr_inventar`) VALUES ('Celeron', '1002');
INSERT INTO `gestiune_angajat_calculator_licente`.`calculator` (`descriere`, `nr_inventar`) VALUES ('Celeron', '1003');


INSERT INTO `gestiune_angajat_calculator_licente`.`licenta` (`tip`, `produs`, `producator`, `valoare`, `document`) VALUES ('OEM', 'Wndows XP', 'Microsoft', 500, '34/20.01.2006');
INSERT INTO `gestiune_angajat_calculator_licente`.`licenta` (`tip`, `produs`, `producator`, `valoare`, `document`) VALUES ('Retail', 'Office XP', 'Microsoft', 1200, '234/11.01.2007');
INSERT INTO `gestiune_angajat_calculator_licente`.`licenta` (`tip`, `produs`, `producator`, `valoare`, `document`) VALUES ('Free', 'openOffice', 'XXX', 0, 'NA');
INSERT INTO `gestiune_angajat_calculator_licente`.`licenta` (`tip`, `produs`, `producator`, `valoare`, `document`) VALUES ('OPEN', 'Windows2000', 'Microsoft', 400, '23/02.02.2003');
INSERT INTO `gestiune_angajat_calculator_licente`.`licenta` (`tip`, `produs`, `producator`, `valoare`, `document`) VALUES ('Free', '7zip', 'XXX', 0, 'NA');


INSERT INTO `gestiune_angajat_calculator_licente`.`angajat_calculator` (`id_angajat`, `id_calculator`) VALUES ('1', '1');
INSERT INTO `gestiune_angajat_calculator_licente`.`angajat_calculator` (`id_angajat`, `id_calculator`) VALUES ('2', '2');
INSERT INTO `gestiune_angajat_calculator_licente`.`angajat_calculator` (`id_angajat`, `id_calculator`) VALUES ('1', '3');
INSERT INTO `gestiune_angajat_calculator_licente`.`angajat_calculator` (`id_angajat`, `id_calculator`) VALUES ('3', '4');


INSERT INTO `gestiune_angajat_calculator_licente`.`calculator_licenta` (`id_calculator`, `id_licenta`) VALUES ('1', '1');
INSERT INTO `gestiune_angajat_calculator_licente`.`calculator_licenta` (`id_calculator`, `id_licenta`) VALUES ('1', '3');
INSERT INTO `gestiune_angajat_calculator_licente`.`calculator_licenta` (`id_calculator`, `id_licenta`) VALUES ('2', '2');
INSERT INTO `gestiune_angajat_calculator_licente`.`calculator_licenta` (`id_calculator`, `id_licenta`) VALUES ('3', '4');
INSERT INTO `gestiune_angajat_calculator_licente`.`calculator_licenta` (`id_calculator`, `id_licenta`) VALUES ('4', '5');

4.
delimiter //
Create PROCEDURE insert_calculator_angajat(IN p_id_angajat INT, IN p_id_calculator INT)
BEGIN
	INSERT INTO angajat_calculator(id_angajat, id_calculator) VALUES (p_id_angajat, p_id_calculator);
END//

CALL insert_calculator_angajat(1,1);

5.
SELECT
    licenta.produs, COUNT(*) AS nr_licente, SUM(valoare) AS valoare_totala
FROM
    licenta
GROUP BY producator;

6.
SELECT
    producator, tip, COUNT(*) AS nr_licente, SUM(valoare) AS valoare_totala
FROM
    licenta
GROUP BY producator , tip , RIGHT(document, 4)
ORDER BY RIGHT(document, 4) DESC , producator , tip;

9.
SELECT
    calculator.nr_inventar,
    angajat.nume,
    angajat.prenume,
    angajat.nr_legitimatie,
    GROUP_CONCAT(produs) AS produse,
    CASE
        WHEN TRIM(LOWER(produs)) LIKE "%office%" THEN "Windows"
        WHEN TRIM(LOWER(produs)) LIKE "%windows%" THEN "Office"
        ELSE "Windows,Office"
    END AS produse_lipsa
FROM
    calculator
        INNER JOIN
    angajat_calculator ON calculator.id = angajat_calculator.id_calculator
        INNER JOIN
    angajat ON angajat_calculator.id_angajat = angajat.id
        INNER JOIN
    calculator_licenta ON calculator_licenta.id_calculator = calculator.id
        INNER JOIN
    licenta ON licenta.id = calculator_licenta.id_licenta
GROUP BY nr_inventar
HAVING (TRIM(LOWER(produse)) NOT LIKE "%windows%"
    OR TRIM(LOWER(produse)) NOT LIKE "%office%");

10.
SELECT
    angajat.id, angajat.nume, angajat.prenume, licenta.valoare
FROM
    angajat
        INNER JOIN
    angajat_calculator ON angajat_calculator.id_angajat = angajat.id
        INNER JOIN
    calculator_licenta ON calculator_licenta.id_calculator = angajat_calculator.id_calculator
        INNER JOIN
    licenta ON licenta.id = calculator_licenta.id_licenta
WHERE
    (SELECT
            MAX(valoare)
        FROM
            licenta) = licenta.valoare;