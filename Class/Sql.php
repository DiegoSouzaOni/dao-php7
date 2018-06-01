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
	 * Seta os parametros, espera um statment e os parametros(Array)
	 */
	private function setParams($statment, $parameters = [])
	{
		foreach ($parameters as $key => $value)
		{
			$this->setParam($key,$value);
		}
	}

	/**
	 * setParam
	 * Seta um unico parametro, espera um statment, key(chave) e value(valor)
	 */
	private function setParam($statment, $key, $value)
	{
		$statment->bindParam($key,$value);
	}

	/**
	 * query
	 * Abre conexão com banco de dados, prepara os parametros e executa o statment.
	 */	
	public function query($rawQuery, $params = [])
	{

		$statment = $this->connection->prepare($rawQuery);

		$this->setParams($statment, $params);

		$statment->execute();

		return $statment;

	}

	/**
	 * select
	 * Retorna todos os resultados do banco de dados.
	 * return Array
	 */	
	public function select($rawQuery, $params = []):array
	{

		$statment = $this->query($rawQuery, $params);

		return $statment->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>