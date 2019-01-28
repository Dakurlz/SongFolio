<?php
class BaseSQL{

    private $pdo;
    private $table;
    private $data = [];

    public function __construct($id){
        //Avec un singleton c'est mieux
        try{
            $this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASSWORD);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }

        $this->table = get_called_class();
		
		if($id){
			$this->getOneBy(["id"=>$id], true);
		}
    }

    public function __get($attr){
        return $this->data[$attr];
    }

    public function __set($attr, $value){
		if(method_exists($this, 'normalize')){
			$this->data[$attr] = $this->normalize($attr, $value);
		}else{
			$this->data[$attr] = $value;
		}
    }

    public function save(){
        $columns = $this->data;

        if( !isset($columns["id"]) || is_null($columns["id"]) ){
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

        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute( $where );

        if($object){
            $this->data = $query->fetch();
            return $this->data;
        }

        return $query->fetch();
    }

    public function getColumns(){
        $objectVars = get_object_vars($this);
        $classVars = get_class_vars( get_class() );
        return array_diff_key($objectVars, $classVars);
    }
}