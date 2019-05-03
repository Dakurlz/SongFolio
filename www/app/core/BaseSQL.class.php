<?php

declare (strict_types = 1);

namespace app\Core;

use PDO;
use LogicException;
use app\Core\View;


class BaseSQL
{

    private $pdo;
    private $table;
    private $data = [];

    public function __construct($id)
    {
        // Avec un singleton c'est mieux
        try {
            $this->pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (LogicException $e) {
            View::show404("Erreur SQL : " . $e->getMessage());
        }

        $this->table = Helper::getCalledClass(get_called_class());

        if ($id) {
            $this->getOneBy(["id" => $id], true);
        }
    }

    public function __get($attr)
    {
        if (isset($this->data[$attr])) {
            if (method_exists($this, 'customGet')) {
                return $this->customGet($attr, $this->data[$attr]);
            } else {
                return $this->data[$attr];
            }
        } else {
            return false;
        }
    }

    public function __set($attr, $value)
    {
        if (method_exists($this, 'customSet')) {
            $this->data[$attr] = $this->customSet($attr, $value);
        } else {
            $this->data[$attr] = $value;
        }
    }

    public function save(): void
    {
        $columns = $this->data;

        if (!isset($columns["id"]) || is_null($columns["id"])) {
            //INSERT
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ") VALUES (:" . implode(",:", array_keys($columns)) . ")";
            $query = $this->pdo->prepare($sql);
            $query->execute($columns);
        } else {
            //UPDATE

            $sqlSet = self::sqlWhere($columns);

            $sql = "UPDATE " . $this->table . " SET " . implode(",", $sqlSet) . " WHERE id=:id";

            $query = $this->pdo->prepare($sql);
            $query->execute($columns);
        }
    }


    public function delete(array $where)
    {
        $sqlWhere = $this->sqlWhere($where);

        $sql = "DELETE FROM " . $this->table . " WHERE " . implode(" AND ", $sqlWhere) . ";";

        $query = $this->pdo->prepare($sql);
        $query->execute($where);
    }

    private function sqlWhere($where)
    {
        foreach ($where as $key => $value) {
            $sqlWhere[] = $key . "=:" . $key;
        }
        return $sqlWhere;
    }

    public function getAllData($object = false)
    {
        $sql = "SELECT * FROM " . $this->table . ";";
        $query = $this->pdo->prepare($sql);
        if ($object) {
            $query->setFetchMode(PDO::FETCH_INTO, $this);
        } else {
            $query->setFetchMode(PDO::FETCH_ASSOC);
        }
        $query->execute();
        return $query->fetchAll();
    }


    public function getOneBy(array $where, $object = false)
    {
        $sqlWhere = $this->sqlWhere($where);
        $sql = "SELECT * FROM " . $this->table . " WHERE " . implode(" AND ", $sqlWhere);
        $query = $this->pdo->prepare($sql);

        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($where);

        if ($object) {
            $this->data = $query->fetch();
            return $this->data;
        }

        return $query->fetch();
    }
    /**
     * Undocumented function
     *
     * @param array $where
     * @return array
     */
    public function getAllBy(array $where): array
    {
        $sqlWhere = $this->sqlWhere($where);
        $sql = "SELECT * FROM " . $this->table . " WHERE " . implode(" AND ", $sqlWhere);
        $query = $this->pdo->prepare($sql);

        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($where);

        return $query->fetchAll();
    }



    public function getCustomQuery(array $where, string $query)
    {
        $sqlWhere = $this->sqlWhere($where);
        $sql = $query . " WHERE " . implode(" AND ", $sqlWhere) . ";";


        $query = $this->pdo->prepare($sql);

        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($where);

        return $query->fetch();
    }

    public function getColumns()
    {
        $objectVars = get_object_vars($this);
        $classVars = get_class_vars(get_class());
        return array_diff_key($objectVars, $classVars);
    }
}
