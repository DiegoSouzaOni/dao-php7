<?php 

/**
 * Usuario
 */
class Usuario
{

	private $idUsuario;
	private $desLogin;
	private $desSenha;
	private $datCadastro;
	
	/**
	 * getIdUsuario
	 * @return Int
	 */
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}

	/**
	 * setIdUsuario
	 */
	public function setIdUsuario($value)
	{
		$this->idUsuario = $value;
	}

	/**
	 * getDesLogin
	 * @return String
	 */
	public function getDesLogin()
	{
		return $this->desLogin;
	}

	/**
	 * setDesLogin
	 */
	public function setDesLogin($value)
	{
		$this->desLogin = $value;
	}

	/**
	 * getDesSenha
	 * @return String
	 */
	public function getDesSenha()
	{
		return $this->desSenha;
	}

	/**
	 * setDesSenha
	 */
	public function setDesSenha($value)
	{
		$this->desSenha = $value;
	}

	/**
	 * getDatCadastro
	 * @return DateTime
	 */
	public function getDatCadastro()
	{
		return $this->datCadastro;
	}

	/**
	 * setDatCadastro
	 */
	public function setDatCadastro($value)
	{
		$this->datCadastro = $value;
	}

	/**
	 * loadById
	 * Busca usuário por ID
	 */
	public function loadById($id)
	{
		$sql = new SQL();
		$result = $sql->select("SELECT * FROM Usuarios WHERE idUsuario = :ID", [":ID"=>$id]);

		if(count($result) > 0) {
			$row = $result[0];

			$this->setData($result[0]);
		}

	}

	/**
	 * getList
	 * Busca usuário e retorna uma lista ordenada
	 */
	public static function getList()
	{

		$sql = new SQL();
		return $sql->select("SELECT * FROM Usuarios ORDER BY idUsuario DESC");

	}

	/**
	 * search
	 * Busca usuário pela string passada
	 */
	public static function search($login)
	{
		$sql = new SQL();
		return $sql->select("SELECT * FROM Usuarios WHERE desLogin LIKE :desLogin ORDER BY idUsuario DESC", [":desLogin"=>"%".$login."%"]);
	}

	/**
	 * login
	 * Verifica se o usuario existe, caso exista seta os dados, caso não retorna erro
	 */
	public function login($login, $senha)
	{
		$sql = new SQL();
		$result = $sql->select("SELECT * FROM Usuarios WHERE desLogin = :desLogin AND desSenha = :desSenha", [":desLogin"=>$login, ":desSenha"=>$senha]);

		if(count($result) > 0) {
			$row = $result[0];
			
			$this->setData($result[0]);
		}
		else {
			throw new Exception("Usuário não encontrado!", 1);
			
		}
	}

	/**
	 * insert
	 * Cria novo usuário no banco de dados.
	 */
	public function insert()
	{
		$sql = new Sql();
		$result = $sql->select("CALL sp_usuarios_insert(:desLogin,:desSenha)",
			[
				":desLogin" => $this->getDesLogin(), 
				":desSenha" => $this->getDesSenha()
			]
		);

		if(count($result) > 0){
			$this->setData($result[0]);
		}
	}

	/**
	 * insert
	 * Cria novo usuário no banco de dados.
	 */
	public function update($login, $senha)
	{
		$this->setDesLogin($login);
		$this->setDesSenha($senha);

		$sql = new Sql();
		$sql->query("UPDATE Usuarios SET desLogin = :desLogin, desSenha = :desSenha WHERE idUsuario = :idUsuario",
			[
				":desLogin" => $this->getDesLogin(), 
				":desSenha" => $this->getDesSenha(),
				":idUsuario" => $this->getIdUsuario()
			]
		);
	}

	/**
	 * delete
	 * Cria novo usuário no banco de dados.
	 */
	public function deleteById()
	{
		$sql = new Sql();
		$sql->query("DELETE FROM Usuarios WHERE idUsuario = :idUsuario",
			[
				":idUsuario" => $this->getIdUsuario()
			]
		);

		$this->setIdUsuario(0);
		$this->setDesLogin("");
		$this->setDesSenha("");
		$this->setDatCadastro(new DateTime());
	}

	/**
	 * setData
	 * Seta dados do retorno.
	 */
	public function setData($data)
	{
		$this->setIdUsuario($data['idUsuario']);
		$this->setDesLogin($data['desLogin']);
		$this->setDesSenha($data['desSenha']);
		$this->setDatCadastro(new DateTime($data['datCadastro']));
	}

	/**
	 * __construct
	 * Metodo mágico para retornar os dados em json
	 */
	public function __construct($login = "", $senha = "")
	{
		$this->setDesLogin($login);
		$this->setDesSenha($senha);
	}

	/**
	 * __toString
	 * Metodo mágico para retornar os dados em json
	 */
	public function __toString()
	{
		return json_encode([
			"idUsuario" => $this->getIdUsuario(),
			"desLogin" => $this->getDesLogin(),
			"desSenha" => $this->getDesSenha(),
			"datCadastro" => $this->getDatCadastro()->format("d/m/Y h:m:s")
		]);
	}
}

?>