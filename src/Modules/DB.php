<?php namespace App\Modules;

use PDO;
class DB
{

    protected $pdo = null;
    protected $table;
    private $host = "localhost";
    private $db_name = "authentication";
    private $host_name = "root";
    private $host_password = "";

    public function __construct()
    {
        $pd = $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db_name}", "{$this->host_name}", "{$this->host_password}");
        $pd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function addUsers(array $data)
    {

        $values = join(",", array_keys($data));
        $params = join(",", array_map(fn($item) => ":$item", array_keys($data)));
        $stmt = $this->pdo->prepare("INSERT INTO {$this -> table} ({$values}) values ({$params})");
        return $stmt->execute($data);
    }

    public function selectUsers($data)
    {

        $values = join(",", array_keys($data));
        $params = join(",", array_map(fn($item) => ":$item", array_keys($data)));
        $stmt = $this->pdo->prepare("SELECT * FROM {$this -> table} WHERE {$values} = {$params}");

        $stmt->execute($data);
        return $stmt->fetch();
    }
}
