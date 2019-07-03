<?php

declare (strict_types = 1);

namespace Songfolio\Core;

use PDO;
use LogicException;
use Songfolio\Core\View;


class BaseSQL
{

    private $pdo;
    private $table;
    private $data = [];

    public function __construct($initIdOrSearch = null)
    {
        // Avec un singleton c'est mieux
        try {
            $this->pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (LogicException $e) {
            View::show404("Erreur SQL : " . $e->getMessage());
        }

        $this->table = Helper::getCalledClass(get_called_class());

        if(!empty($initIdOrSearch) && is_array($initIdOrSearch))
        {
            $this->getOneBy($initIdOrSearch, true);
        }
        else if (!empty($initIdOrSearch))
        {
            $this->getOneBy(["id" => $initIdOrSearch], true);
        }
    }

    public function id(){
        if(!empty($this->data['id'])){
            return $this->data['id'];
        }

        return null;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->getOneBy(['id' => $id], true);
    }

    public function __getData(){
        if (isset($this->data)) {
            return $this->data;
        }
        return false;
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

    public function __remove($attr)
    {
        if (isset($this->data[$attr])) unset($this->data[$attr]);
        return false;
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


            $this->data['id'] = $this->pdo->lastInsertId($this->table);
        } else {
            //UPDATE

            $sqlSet = self::sqlWhere($columns);

            $sql = "UPDATE " . $this->table . " SET " . implode(",", $sqlSet) . " WHERE id=:id";

            $query = $this->pdo->prepare($sql);
            $query->execute($columns);
        }
    }

    public function remove(): void
    {
        if($this->id()){
            $sql = "DELETE FROM " . $this->table . " WHERE id=".$this->id().";";

            $query = $this->pdo->prepare($sql);
            $query->execute($where);
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

    public function getAllData()
    {
        $sql = "SELECT * FROM " . $this->table . ";";
        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllDataWithLimit($limit)
    {
        $sql = "SELECT * FROM " . $this->table . " LIMIT $limit;";
        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC);
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
            //$query->setFetchMode(\PDO::FETCH_INTO, $this);
        } else {
            $query->setFetchMode(\PDO::FETCH_ASSOC);
        }

        return $query->fetch();
    }
    /**
     * Undocumented function
     *
     * @param array $where
     * @return array
     */
    public function getAllBy(array $where, array $params = []): array
    {
        $order = 1;
        if(isset($params['orderBy'])){
            $order = $params['orderBy']." ".$params['orderTo'] ?? 'ASC';
        }

        $sqlWhere = $this->sqlWhere($where);
        $sql = "SELECT * FROM " . $this->table . " WHERE " . implode(" AND ", $sqlWhere)." ORDER BY ".$order;
        $query = $this->pdo->prepare($sql);

        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($where);

        return $query->fetchAll();
    }



    public function getByCustomQuery(array $where, string $customQuery)
    {
        $sqlWhere = $this->sqlWhere($where);
        $sql =  'SELECT '. $customQuery . " FROM " . $this->table .  " WHERE " . implode(" AND ", $sqlWhere) . ";";
        $query = $this->pdo->prepare($sql);

        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($where);

        return $query->fetch();
    }

    public function getCustom(string $str,array $where)
    {
        $sqlWhere = $this->sqlWhere($where);
        $sql =  $str." WHERE " . implode(" AND ", $sqlWhere) . ";";
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
