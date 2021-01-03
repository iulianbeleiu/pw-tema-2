# Pw-tema-2 - Documentatie

### Structura
```
--docker
    --database
    --nginx
    --php-fpm
--tema
    --Sql
        --Conexiune.php
        --Query.php
    --database.sql
    --ex1.php
    --ex2.php
    --ex3.php
    --ex4.php
    --index.php
```
Docker (Nginx + MariaDb + Php FPM)
3 servicii care se gasesc in docker-compose.yml
Pentru a rula proiectul este nevoie de docker apoi rulati:
```
1. docker-compose up
2. Comenzile de creeare de tabele din database.sql
```

Conexiune.php este un singleton care creeaza conexiunea la baza de date

Query.php contine toate functiile de sql necesare

Exercitiile se gasesc in fisiere php separate (ex1, ex2, ex3, ex4) dar se pot accesa si din index.php din meniu
