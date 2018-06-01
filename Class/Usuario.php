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

	public function loadById($id)
	{
		$sql = new SQL();
		$result = $sql->select("SELECT * FROM Usuarios WHERE idUsuario = :ID", [":ID"=>$id]);

		if(count($result) > 0) {
			$row = $result[0];

			$this->setIdUsuario($row['idUsuario']);
			$this->setDesLogin($row['desLogin']);
			$this->setDesSenha($row['desSenha']);
			$this->setDatCadastro(new DateTime($row['datCadastro']));
		}

	}

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