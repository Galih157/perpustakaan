<?php

class Database
{
    protected $host = "127.0.0.1";
    protected $username = "root";
    protected $database = "perpustakaan";
    protected $password = "";
    protected $driver = "mysql";

    private $connection;

    public function __construct()
    {
        if (!$this->connection) {
            $options = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];

            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password, $options);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function getData($table, $columns = ['*'])
    {
        $selectColumns = implode(',', $columns);
        $query = "SELECT {$selectColumns} FROM {$table}";

        $preparedStatement = $this->getConnection()->prepare($query);
        $preparedStatement->execute();

        return $preparedStatement->fetchAll();
    }

    public function insertData($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), "?"));
        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

        $preparedStatement = $this->getConnection()->prepare($query);

        return $preparedStatement->execute(array_values($data));
    }

    public function hapusData($table, $where = null)
    {
        $query = "DELETE FROM {$table}";

        if (is_array($where)) {
            $wheres = [];

            foreach ($where as $column => $value) {
                $wheres[] = "{$column}=?";
            }

            $whereString = implode(' ', $wheres);

            $query = "{$query} WHERE {$whereString}";
        }

        $preparedStatement = $this->getConnection()->prepare($query);

        return $preparedStatement->execute(array_values($where));
    }

    public function updateData($table, $data, $where)
    {
        $sets = [];

        foreach ($data as $column => $value) {
            $sets[] = "{$column}=?";
        }

        $setQuery = implode(',', $sets);

        $query = "UPDATE {$table} SET {$setQuery}";

        if (is_array($where)) {
            $wheres = [];

            foreach ($where as $column => $value) {
                $wheres[] = "{$column}=?";
            }

            $whereString = implode(' ', $wheres);

            $query = "{$query} WHERE {$whereString}";
        }

        $preparedStatement = $this->getConnection()->prepare($query);

        return $preparedStatement->execute(array_merge(array_values($data), array_values($where)));
    }
}
