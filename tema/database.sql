CREATE DATABASE tema;

# 1.
CREATE TABLE tema.table1 (
    nr_crt INT auto_increment NOT NULL,
    produs varchar(100) NULL,
    bucati INT NULL,
    pret_bucata FLOAT NULL,
    pret_total FLOAT NULL,
    primary key (nr_crt)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

INSERT INTO tema.table1
(produs, bucati, pret_bucata, pret_total)
VALUES('p1', 2, 23, 46);

# 2.
CREATE TABLE tema.oameni (
    nume varchar(100) NULL,
    varsta INT NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

INSERT INTO tema.oameni
(nume, varsta)
VALUES('iulian', 25);

INSERT INTO tema.oameni
(nume, varsta)
VALUES('andrei', 64);

INSERT INTO tema.oameni
(nume, varsta)
VALUES('mircea', 88);

SELECT nume, varsta FROM tema.oameni WHERE varsta = 25;


# 3.
CREATE TABLE tema.articol (
     id INT auto_increment NOT NULL,
     nume varchar(100) NULL,
     cantitate INT NULL,
     pret FLOAT NULL,
     primary key (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

INSERT INTO tema.articol (nume, pret, cantitate)
VALUES (:nume1, :pret1, :cantitate1),
       (:nume2, :pret2, :cantitate2);

# 4.
DELETE FROM tema.oameni WHERE varsta = :varsta;
