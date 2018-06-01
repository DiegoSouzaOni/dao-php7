<?php 

/**
 * class SQL
 * 
 */
class Sql extends PDO
{

	private $connection;

	/**
	 * constructor
	 * Faz atribuição dos dados de conexão com banco de dados.
	 */
	public function __construct()
	{
		$this->connection = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
	}

	/**
	 * setParams
	 * Seta os parametros, espera um statement e os parametros(Array)
	 */
	private function setParams($statement, $parameters = [])
	{
		foreach ($parameters as $key => $value)
		{
			$this->setParam($statement,$key,$value);
		}
	}

	/**
	 * setParam
	 * Seta um unico parametro, espera um statement, key(chave) e value(valor)
	 */
	private function setParam($statement, $key, $value)
	{
		$statement->bindParam($key,$value);
	}

	/**
	 * query
	 * Abre conexão com banco de dados, prepara os parametros e executa o statement.
	 */	
	public function query($rawQuery, $params = [])
	{

		$statement = $this->connection->prepare($rawQuery);

		$this->setParams($statement, $params);

		$statement->execute();

		return $statement;

	}

	/**
	 * select
	 * Retorna todos os resultados do banco de dados.
	 * return Array
	 */	
	public function select($rawQuery, $params = []):array
	{

		$statement = $this->query($rawQuery, $params);

		return $statement->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>