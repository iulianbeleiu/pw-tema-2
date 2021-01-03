<?php

require 'DatabaseConnection.php';

class Statements
{
    private $connection = null;

    public function __construct()
    {
        $instance = DatabaseConnection::getInstance();
        $this->connection = $instance->getConnection();
    }

    public function getAllEployeesComputersAndProducts()
    {
        try {
            $query = '
                SELECT
                    angajat.nume,
                    angajat.prenume,
                    angajat.nr_legitimatie,
                    calculator.descriere,
                    calculator.nr_inventar,
                    licenta.tip,
                    licenta.produs,
                    licenta.producator,
                    licenta.valoare,
                    licenta.document
                FROM
                    angajat
                        INNER JOIN
                    angajat_calculator ON angajat_calculator.id_angajat = angajat.id
                        INNER JOIN
                    calculator_licenta ON calculator_licenta.id_calculator = angajat_calculator.id_calculator
                        INNER JOIN
                    licenta ON licenta.id = calculator_licenta.id_licenta
                        INNER JOIN
                    calculator ON calculator.id = angajat_calculator.id_calculator;
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function insertEmployee($nume, $prenume, $nrLegitimatie)
    {
        try {
            $statement = $this->connection->prepare("
                INSERT INTO angajat (nume, prenume, nr_legitimatie)
                    VALUES (:nume, :prenume, :nr_legitimatie)
            ");
            $statement->bindParam(':nume', $nume);
            $statement->bindParam(':prenume', $prenume);
            $statement->bindParam(':nr_legitimatie', $nrLegitimatie);

            $statement->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $exception) {
            return null;
        }
    }

    public function insertComputer($descriere, $nrInventar)
    {
        try {
            $statement = $this->connection->prepare("
                INSERT INTO calculator (descriere, nr_inventar)
                    VALUES (:descriere, :nr_inventar)
            ");
            $statement->bindParam(':descriere', $descriere);
            $statement->bindParam(':nr_inventar', $nrInventar);

            $statement->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $exception) {
            return null;
        }
    }

    public function insertLicenta($tip, $produs, $producator, $valoare, $document)
    {
        try {
            $statement = $this->connection->prepare("
                INSERT INTO licenta (tip, produs, producator, valoare, document)
                    VALUES (:tip, :produs, :producator, :valoare, :document)
            ");
            $statement->bindParam(':tip', $tip);
            $statement->bindParam(':produs', $produs);
            $statement->bindParam(':producator', $producator);
            $statement->bindParam(':valoare', $valoare);
            $statement->bindParam(':document', $document);

            $statement->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $exception) {
            return null;
        }
    }

    public function insertEmployeeComputer($id_angajat, $id_calculator)
    {
        try {
            $statement = $this->connection->prepare("
                INSERT INTO angajat_calculator(id_angajat, id_calculator)
                    VALUES (:id_angajat, :id_calculator)
            ");
            $statement->bindParam(':id_angajat', $id_angajat);
            $statement->bindParam(':id_calculator', $id_calculator);

            $statement->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getAllEmployees()
    {
        try {
            $query = '
                SELECT
                    *
                FROM
                    angajat;
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function getAllComputers()
    {
        try {
            $query = '
                SELECT
                    *
                FROM
                    calculator;
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function getAllLicences()
    {
        try {
            $query = '
                SELECT
                    *
                FROM
                    licenta;
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function getAllEmployeeComputers()
    {
        try {
            $query = '
            SELECT
                angajat.nume,
                angajat.prenume,
                angajat.nr_legitimatie,
                calculator.descriere,
                calculator.nr_inventar
            FROM
                evidenta_calculatoare_licente.angajat
                    INNER JOIN
                angajat_calculator ON angajat_calculator.id_angajat = angajat.id
                    INNER JOIN
                calculator ON calculator.id = angajat_calculator.id_calculator;
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function getAllComputerLicences()
    {
        try {
            $query = '
            SELECT
                calculator.descriere,
                calculator.nr_inventar,
                licenta.tip,
                licenta.produs
            FROM
                evidenta_calculatoare_licente.calculator
                    INNER JOIN
                calculator_licenta ON calculator_licenta.id_calculator = calculator.id
                    INNER JOIN
                licenta ON licenta.id = calculator_licenta.id_licenta;
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function insertComputerLicence($id_calculator, $id_licenta)
    {
        try {
            $statement = $this->connection->prepare("
                INSERT INTO calculator_licenta(id_calculator, id_licenta)
                    VALUES (:id_calculator, :id_licenta)
            ");
            $statement->bindParam(':id_calculator', $id_calculator);
            $statement->bindParam(':id_licenta', $id_licenta);

            $statement->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getLicencesTotalValueByProducer()
    {
        try {
            $query = '
            SELECT
                licenta.producator,COUNT(*) AS nr_licente, SUM(valoare) AS valoare_totala
            FROM
                licenta
            GROUP BY producator;
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function detailedReport()
    {
        try {
            $query = '
            SELECT
                producator, tip, COUNT(*) AS nr_licente, SUM(valoare) AS valoare_totala
            FROM
                licenta
            GROUP BY producator , tip , RIGHT(document, 4)
            ORDER BY RIGHT(document, 4) DESC , producator , tip;
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function employeesNoProducts()
    {
        try {
            $query = '
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
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function maxValue()
    {
        try {
            $query = '
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
            ';
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }
}