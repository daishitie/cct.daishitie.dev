<?php

namespace Covid\App\Libraries;

use PDO;
use PDOException;

class Database
{
    private $dbConnection;
    private $dbOptions;
    private $dbQuery;
    private $dbHandler;

    public function __construct()
    {
        try {
            $this->dbConnection = 'mysql:host=' . config('db.host') . ';dbname=' . config('db.database') . ';charset=' . config('db.charset') . ';port=' . config('db.port');
            $this->dbOptions = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
            ];

            $this->dbHandler = new PDO($this->dbConnection, config('db.username'), config('db.password'), $this->dbOptions);
        } catch (PDOException $exception) {
            exit('Unable to connect to data center.');
        }
    }

    public function query($query)
    {
        return $this->dbQuery = $this->dbHandler->prepare($query);
    }

    public function bind($parameter, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        return $this->dbQuery->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        return $this->dbQuery->execute();
    }

    /**
     * FindAll
     *
     * @param string $fetchStyle assoc, both, lazy, default: obj
     *
     * @return data
     */
    public function findAll($fetchStyle = null)
    {
        switch ($fetchStyle) {
            case 'assoc':
                $fetchStyle = PDO::FETCH_ASSOC;
                break;
            case 'both':
                $fetchStyle = PDO::FETCH_BOTH;
                break;
            case 'lazy':
                $fetchStyle = PDO::FETCH_LAZY;
                break;
            default:
                $fetchStyle = PDO::FETCH_OBJ;
        }

        $this->execute();
        return $this->dbQuery->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Find
     *
     * @param string $fetchStyle assoc, both, lazy, default: obj
     *
     * @return data
     */
    public function find($fetchStyle = null)
    {
        switch ($fetchStyle) {
            case 'assoc':
                $fetchStyle = PDO::FETCH_ASSOC;
                break;
            case 'both':
                $fetchStyle = PDO::FETCH_BOTH;
                break;
            case 'lazy':
                $fetchStyle = PDO::FETCH_LAZY;
                break;
            default:
                $fetchStyle = PDO::FETCH_OBJ;
        }

        $this->execute();
        return $this->dbQuery->fetch($fetchStyle);
    }

    public function rowCount()
    {
        $this->execute();
        return $this->db_query->rowCount();
    }
}
