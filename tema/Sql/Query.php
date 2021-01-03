<?php

require 'Conexiune.php';

class Query
{
    private $connection = null;

    public function __construct()
    {
        $instance = Conexiune::getInstance();
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

    public function adaugaArticole(array $articole)
    {
        try {
            $statement = $this->connection->prepare("
                INSERT INTO articol (nume, pret, cantitate)
                    VALUES (:nume1, :pret1, :cantitate1),
                           (:nume2, :pret2, :cantitate2)
            ");
            $statement->bindParam(':nume1', $articole['nume1']);
            $statement->bindParam(':pret1', $articole['pret1']);
            $statement->bindParam(':cantitate1', $articole['cantitate1']);

            $statement->bindParam(':nume2', $articole['nume2']);
            $statement->bindParam(':pret2', $articole['pret2']);
            $statement->bindParam(':cantitate2', $articole['cantitate2']);

            $statement->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $exception) {
            return null;
        }
    }

    public function articole()
    {
        try {
            $query = '
                SELECT * FROM articol;
            ';

            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function stergeDupaVarsta($varsta)
    {
        try {
            $query = '
                DELETE FROM oameni WHERE varsta = :varsta;
            ';

            $statement = $this->connection->prepare($query);
            $statement->bindParam(':varsta', $varsta);
            $statement->execute();

            return $statement->rowCount();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function verificaArticole($produs, $pretBucata)
    {
        try {
            $query = '
                SELECT * FROM table1 WHERE produs = :produs AND pret_bucata = :pretBucata;
            ';

            $statement = $this->connection->prepare($query);
            $statement->bindParam(':produs', $produs);
            $statement->bindParam(':pretBucata', $pretBucata);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            return $statement->fetchAll();
        } catch (Exception $exception) {
            return [];
        }
    }

    private function stergeArticol($nrCrt)
    {
        try {
            $query = '
                DELETE FROM table1 WHERE nr_crt = :nrCrt;
            ';

            $statement = $this->connection->prepare($query);
            $statement->bindParam(':nrCrt', $nrCrt);
            $statement->execute();

            return $statement->rowCount();
        } catch (Exception $exception) {
            return [];
        }
    }

    private function editeazaArticol($nrCrt, $bucati, $pretTotal)
    {
        try {
            $statement = $this->connection->prepare("
                UPDATE table1 set bucati = :bucati, pret_total = :pretTotal
                    WHERE nr_crt = :nrCrt;
            ");
            $statement->bindParam(':bucati', $bucati);
            $statement->bindParam(':pretTotal', $pretTotal);
            $statement->bindParam(':nrCrt', $nrCrt);

            $statement->execute();

            return $statement->rowCount();
        } catch (Exception $exception) {
            return null;
        }
    }

    public function doMagic(array $articoleVerificate)
    {
        $articol1 = $articoleVerificate[0];
        $articol2 = $articoleVerificate[1];

        $nrBucati = $articol1['bucati'] + $articol2['bucati'];
        $pretTotal = $articol1['pret_total'] + $articol2['pret_total'];

        if ($this->editeazaArticol($articol1['nr_crt'], $nrBucati, $pretTotal)) {
            $this->stergeArticol($articol2['nr_crt']);
            return true;
        }

        return false;
    }

    public function toateArticolele()
    {
        try {
            $query = '
                SELECT * FROM table1;
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