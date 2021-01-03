CREATE DATABASE tema_pw;

# 2.
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


# 3.
CREATE TABLE tema_pw.articol (
     id INT auto_increment NOT NULL,
     nume varchar(100) NULL,
     cantitate INT NULL,
     pret FLOAT NULL,
     primary key (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

INSERT INTO tema_pw.articol (nume, pret, cantitate)
VALUES (:nume1, :pret1, :cantitate1),
       (:nume2, :pret2, :cantitate2)

