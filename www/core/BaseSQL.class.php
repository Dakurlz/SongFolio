<?php
class BaseSQL{

	private $pdo;
	private $table;

	public function __construct(){
		//Avec un singleton c'est mieux ...
		try{
			$this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
		}catch(Exception $e){
			die(" Erreur SQL : ".$e->getMessage());
		}

		$this->table = get_called_class();



	}

	public function getColumns(){

		$objectVars = get_object_vars($this);
		$classVars = get_class_vars( get_class() );
		$columns = array_diff_key($objectVars, $classVars);
		return $columns;
	}

	//Dynamique en fonction de l'enfant qui en hérite
	public function save(){
		$columns = $this->getColumns();
		//Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$61V4lLXpk4ph.q5/sgRIlesTAoQ3DOaL1puwZlWhX8.czoMDTFL/G [status] => 0 [role] => 1 )

		if( is_null($columns["id"])){
			//INSERT

			$sql = "INSERT INTO ".$this->table." (".implode(",", array_keys($columns)).") VALUES (:".implode(",:", array_keys($columns)).")";

			$query = $this->pdo->prepare($sql);
			$query->execute( $columns );

		}else{
			//UPDATE

			foreach ($columns as $key => $value) {
				$sqlSet[] = $key."=:".$key;
			}

			$sql = "UPDATE ".$this->table." SET ".implode(",", $sqlSet)." WHERE id=:id";

			$query = $this->pdo->prepare($sql);
			$query->execute( $columns );

		}



	}

	//Example : array $where=["id"=>3]
	public function getOneBy(array $where){
		foreach ($where as $key => $value) {
				$sqlWhere[] = $key."=:".$key;
			}

		$sql = "SELECT * FROM ".$this->table." 
				WHERE ".implode(" AND ", $sqlWhere);

		$query = $this->pdo->prepare($sql);
		$query->setFetchMode(PDO::FETCH_INTO, $this);
		$query->execute( $where );
		$query->fetch();

	}


}








