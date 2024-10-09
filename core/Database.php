<?php

    namespace core;

    use PDO;
    use PDOStatement;

    class Database
    {
        public PDO $connection;

        public PDOStatement $statement;

        public function __construct($config, $username = 'root', $password = '')
        {
            $dsn = 'mysql:host' . http_build_query($config, '', ';');

            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        public function query($query, $params = []) : Database
        {
            $this->statement = $this->connection->prepare($query);

            $this->statement->execute($params);

            return $this;
        }

        public function findOrFail()
        {
            $result = $this->find();

            if (!$result) {
                abort(Response::NOT_FOUND);
            }

            return $result;
        }

        public function find()
        {
            $result = $this->statement->fetch();
            return gettype($result) === 'boolean' ? [] : $result;
        }

        public function findAll() {
            return $this->statement->fetchAll();
        }
    }
