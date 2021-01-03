CREATE DATABASE tema_pw;

CREATE TABLE tema_pw.oameni (
    nume varchar(100) NULL,
    varsta INT NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

INSERT INTO tema_pw.oameni
(nume, varsta)
VALUES('iulian', 25);

INSERT INTO tema_pw.oameni
(nume, varsta)
VALUES('andrei', 30);

SELECT nume, varsta FROM tema_pw.oameni WHERE varsta = 25;

