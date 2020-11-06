<?php
// Основные функции этого класса это подключение к бд и обработака SQL запросов
namespace Services;

class DB_Model
{
    /** @var \PDO */
    private $pdo;

    public function __construct()
    {
        $dbOptions = (require rootPath() . '/src/settingsDb.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }
    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
    public function query(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if (false === $result) {
            return null;
        }
//        return $sth->fetchAll();
//        $sth = $this->pdo->prepare($sql);
//        var_dump($sth);
//        foreach ($params as $key=>$item) {
//            var_dump($key);
//            var_dump($item);
//            $sth->bindParam($key, $item);
//        }
//       $sth->execute();
//        if ($result === false) {
//            echo "\nPDO::errorInfo():\n";
//            var_dump($this->pdo->errorInfo());
//        }
//        if (false === $result) {
//            return null;
//        }
        return $sth->fetchAll();
    }

}