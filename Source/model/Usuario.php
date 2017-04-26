<?php
class Usuario
{
	private $id;
	private $nome;
	private $usuario;
	private $senha;

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setSenha($senha){
		$this->senha = md5($senha);
	}

	public function getSenha(){
		return $this->senha;
	}

	#Verifica se não há campos vazios
	public function verificaVazios($usuario, $senha){
		#teste da hash vazio
		if(($usuario == "") || ($senha == "d41d8cd98f00b204e9800998ecf8427e")){
			return false;
		}else{
			return true;
		}
	}

	#Verifica se já existe este usuário cadastrado
	public function verificaUsuario($usuario){
		if($usuario != NULL){
			require_once("../model/Database.php");
			$DB = Database::conectar();
			$sql = "select usuario from tbUsuario where usuario = :usuario";
			$consulta = $DB->prepare($sql);

			$consulta->bindParam(':usuario', $usuario, PDO::PARAM_STR);
			try{
				$consulta->execute();
				//echo $consulta->rowCount();
				if($consulta->rowCount() == 1){
					return true;
				}
			}catch(PDOException $e){
				echo ($e->getMessage());
				return false;
			}
		}
	}

	#Cadastra o usuário
	public function cadastrar($usuario, $senha){
		if(($usuario != NULL) && ($senha != NULL)){
			require_once("../model/Database.php");
			$DB = Database::conectar();
			$sql = "insert into tbUsuario (id, usuario, senha) values (NULL, :usuario, :senha)";
			$consulta = $DB->prepare($sql);

			$consulta->bindParam(':usuario', $usuario, PDO::PARAM_STR);
			$consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
			try{
				$consulta->execute();
				return true;
			}catch(PDOException $e){
				echo ($e->getMessage());
				return false;
			}
		}else{
			return false;
		}
	}


	#Verifica usuário e senha no DB (usuário e senha md5 crypt);
	public function logar($usuario, $senha){
		if(($usuario != NULL) && ($senha != NULL)){
				require_once("../model/Database.php");
				$DB = Database::conectar();
				$sql = "select id, usuario, senha from tbUsuario where usuario = :usuario and senha = :senha";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':usuario', $usuario, PDO::PARAM_STR);
				$consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
				try{
					$consulta->execute();
					if($consulta->rowCount() == 1){
						$linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
						foreach($linha as $row)						{
							$this->setId($row['id']);
							$this->setUsuario($row['usuario']);
							$this->setSenha($row['senha']);
						}
						return true;
					}
				}catch(PDOException $e){
					echo ($e->getMessage());
					return false;
				}
		}else{
			return false;
		}
	}

	#Seta sessão para o usuário
	public function iniciaSession($usuario){
		if (!session_id()){
    	session_start();
			$_SESSION['usuario'] = $this->usuario;
			$_SESSION['id'] = $this->id;
			return true;
		}else{
			return false;
		}

	}

	#Valida sessão
	public function validaSession(){
		if(!session_id()){
			session_start();
		}
		if(empty($_SESSION['usuario'])){
			return false;
		}else{
			return true;
		}
	}

	#Atualiza senha a partir do id
	public function mudarSenha($id, $senha){
		if(($id != NULL) && ($senha != NULL)){
				require_once("../model/Database.php");
				$DB = Database::conectar();
				$sql = "update tdUsuario set senha= :senha where id = :id";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':id', $id, PDO::PARAM_STR);
				$consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
				try{
					$consulta->execute();
					return true;
				}catch(PDOException $e){
					echo ($e->getMessage());
					return false;
				}
		}
		return false;
	}
}

?>
