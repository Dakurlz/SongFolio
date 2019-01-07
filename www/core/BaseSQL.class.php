<?php
class BaseSQL{

    private $pdo;
    private $table;

    public function __construct(){
        //avec un singleton c'est mieux
        try{
            $this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASSWORD);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }

        $this->table = get_called_class();
    }

    public function save(){
        $columns = $this->getColumns();

        if( is_null($columns["id"]) ){
            //INSERT
            $sql = "INSERT INTO ".$this->table." (".implode(",",array_keys($columns)).") VALUES (:".implode(",:",array_keys($columns)).")";

            $query = $this->pdo->prepare($sql);
            $query->execute( $columns );
        }else{
            //UPDATE

            foreach( $columns as $key => $value){
                $sqlSet[] = $key."=:".$key;
            }
            $sql = "UPDATE ".$this->table." SET ".implode(",", $sqlSet)." WHERE id=:id";

            $query = $this->pdo->prepare($sql);
            $query->execute( $columns );
        }

    }

    public function getOneBy(array $where, $object = false){

        foreach( $where as $key => $value){
            $sqlWhere[] = $key."=:".$key;
        }
        $sql = "SELECT * FROM ".$this->table." WHERE ".implode(" AND",$sqlWhere);

        $query = $this->pdo->prepare($sql);

        if($object){
            $query->setFetchMode(PDO::FETCH_INTO, $this);
        }else{
            $query->setFetchMode(PDO::FETCH_INTO, $this);
        }

        $query->execute( $where );
        return $query->fetch();
    }

    public function getColumns(){
        $objectVars = get_object_vars($this);
        $classVars = get_class_vars( get_class() );
        return array_diff_key($objectVars, $classVars);
    }
}