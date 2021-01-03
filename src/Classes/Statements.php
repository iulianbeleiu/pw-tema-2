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

    public function cautaDupaVarsta($varsta)
    {
        try {
            $query = '
                SELECT nume, varsta FROM oameni
            ';

            if ($varsta) {
                $query .= ' WHERE varsta = :varsta';
            }
            $query .= ';';

            $statement = $this->connection->prepare($query);
            $statement->bindParam(':varsta', $varsta);
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
}