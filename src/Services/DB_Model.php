<?php
// Основные функции этого класса это подключение к бд и обработака SQL запросов
namespace Services;

class DB_Model
{
    /** @var \PDO */
    private $pdo;
    //private $connection;

    public function __construct()
    {
        $dbOptions = (require rootPath() . '/src/settingsDb.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        //$this->connection =  mysqli_connect('127.0.0.1','root','','nixcourse');
        $this->pdo->exec('SET NAMES UTF8');
    }
    public function query(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if (false === $result) {
            return null;
        }

        return $sth->fetchAll();
    }

}